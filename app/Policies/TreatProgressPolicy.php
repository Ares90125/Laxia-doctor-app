<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TreatProgress;
use Illuminate\Auth\Access\HandlesAuthorization;

class TreatProgressPolicy
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
     * @param  \App\Models\TreatProgress  $progress
     * @return bool
     */
    public function update(User $user, TreatProgress $progress)
    {
        $currernt_user = auth()->guard('patient')->user();
        return $currernt_user->patient && 
            $progress->diary && 
            $progress->diary->patient_id == $currernt_user->patient->id;
    }
}
