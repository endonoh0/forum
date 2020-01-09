<?php
// phpcs:ignoreFile
namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_user_can_view_threads()
    {
        // create Thread factory
        $thread = factory(Thread::class)->create();

        //
        //
        $response = $this->get('/threads');
        $response->assertSee($thread->title);

        // view specific thread title
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
