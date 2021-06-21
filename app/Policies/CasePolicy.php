<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TreatCase;
use Illuminate\Auth\Access\HandlesAuthorization;

class CasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TreatCase  $case
     * @return mixed
     */
    public function view(User $user, TreatCase $case)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TreatCase  $case
     * @return mixed
     */
    public function update(User $user, TreatCase $case)
    {
        $clinic = $user->clinic;
        return $clinic && $clinic->id == $case->clinic_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TreatCase  $case
     * @return mixed
     */
    public function delete(User $user, TreatCase $case)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TreatCase  $case
     * @return mixed
     */
    public function restore(User $user, TreatCase $case)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TreatCase  $case
     * @return mixed
     */
    public function forceDelete(User $user, TreatCase $case)
    {
        //
    }
}
