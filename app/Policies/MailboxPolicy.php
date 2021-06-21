<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mailbox;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailboxPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function rw(User $user, Mailbox $mailbox)
    {
        $userIds = $mailbox->users->pluck('id')->toArray();
        return in_array($user->id, $userIds);
    }
}
