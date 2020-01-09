<?php
// phpcs:ignoreFile
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_user_can_view_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}
