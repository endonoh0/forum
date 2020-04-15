<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        $this->withoutExceptionHandling();

        Mail::fake();

        $this->post(route('register'), [
          'name' => 'Joe',
          'email' => 'testemail@test.com',
          'password' => 'passwordtest',
          'password_confirmation' => 'passwordtest',
        ]);

        // Mail::assertSent(PleaseConfirmYourEmail::class);
        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }

    /** @test */
    public function users_can_fully_confirm_their_email_addresses()
    {
        Mail::fake();

        $this->post(route('register'), [
          'name' => 'Joe',
          'email' => 'testemail@test.com',
          'password' => 'passwordtest',
          'password_confirmation' => 'passwordtest',
        ]);

        $user = User::whereName('Joe')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

        $this->get(route('register.confirm', ['token' => $user->confirmation_token]))
            ->assertRedirect(route('threads'));

        $this->assertTrue($user->fresh()->confirmed);
    }

    /** @test */
    public function confirming_an_invalid_token()
    {
        $this->get(route('register.confirm', ['token' => 'invalid']))
          ->assertRedirect(route('threads'))
          ->assertSessionHas('flash', 'Unknown token.');
    }
}
