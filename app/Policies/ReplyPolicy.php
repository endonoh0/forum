<?php

namespace App\Policies;

use App\User;
use App\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the reply.
     *
     * @param   User    $user
     * @param   Reply   $reply
     * @return  bool
     */
    public function update(User $user, Reply $reply)
    {
        return $reply->user_id == $user->id;
    }
}
