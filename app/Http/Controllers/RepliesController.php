<?php
// phpcs:ignoreFile
namespace App\Http\Controllers;

use App\Thread;
use App\channel;

class RepliesController extends Controller
{
    /**
     * Create a new RepliesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Persist a new reply.
     *
     * @param integer $channel Id
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Channel $channel, Thread $thread)
    {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
