<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Diary;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiaryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Diary  $diary
     * @return bool
     */
    public function update(User $user, Diary $diary)
    {
        $currernt_user = auth()->guard('patient')->user();
        return $currernt_user->patient && $diary->patient_id == $currernt_user->patient->id;
    }
}
