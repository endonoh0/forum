<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;

class ThreadSubscriptionsController extends Controller
{
    public function store(Channel $channel, Thread $thread)
    {
        $thread->subscribe();
    }
}
