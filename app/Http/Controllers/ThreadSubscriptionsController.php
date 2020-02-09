<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;

class ThreadSubscriptionsController extends Controller
{
    /**
     * Store a nw thread subscription.
     *
     * @param  Channel $channel The channelId.
     * @param  Thread  $thread
     */
    public function store(Channel $channel, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Delete an existing thread subscriptions.
     *
     * @param  Channel $channel The channel id.
     * @param  Thread $thread
     */
    public function destroy(Channel $channel, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
