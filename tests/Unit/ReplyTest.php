<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_reply_has_an_owner()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->owner);
    }

    /** @test */
    public function it_knows_if_it_was_just_posted()
    {
        $reply = create(Reply::class);

        $this->assertTrue($reply->wasJustPosted());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustPosted());
    }
}
