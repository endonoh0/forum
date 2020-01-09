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
    public function a_user_can_view_all_threads()
    {
        // create Thread factory
        $thread = factory(Thread::class)->create();

        // GET request to collection of threads
        $response = $this->get('/threads');
        $response->assertSee($thread->title); // check thread title
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        // create Thread factory
        $thread = factory(Thread::class)->create();

        // GET request to single thread
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title); // check thread title
    }
}
