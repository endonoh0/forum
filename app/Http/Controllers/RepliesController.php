<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use App\channel;

class RepliesController extends Controller
{
    /**
     * Create a new RepliesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Fetch all relevant replies.
     *
     * @param integer $channel Id
     * @param Thread  $thread
     */
    public function index(Channel $channel, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }

    /**
     * Persist a new reply.
     *
     * @param  integer $channel Id
     * @param  Thread  $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Channel $channel, Thread $thread)
    {
        try {
            request()->validate(['body' => 'required|spamfree']);

            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        } catch (\Exception $e) {
            return response(
                'Sorry, your reply cannot be saved at this time.',
                422
            );
        }

        return $reply->load('owner');
    }

    /**
     * Update an existing reply.
     *
     * @param Reply $reply
     */
    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        try {
            $this->validate(request(), ['body' => 'required|spamfree']);

            $reply->update(request(['body']));
        } catch (\Exception $e) {
            return response(
                'Sorry, your reply cannot be saved at this time.',
                422
            );
        }
    }

    /**
     * Delete the given reply.
     *
     * @param  Reply $reply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }
}
