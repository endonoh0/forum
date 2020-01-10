<?php
// phpcs:ignoreFile
namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        // given we have an authenticated user
        $this->be($user = factory(User::class)->create());

        // given we have thread
        $thread = factory(Thread::class)->create();

        // given we have a reply
        $reply = factory(Reply::class)->make();

        // when the user adds a reply to the thread
        $this->post($thread->path() . '/replies', $reply->toArray());

        // then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
