<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class RsvPolicy
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
     * @param  \App\Models\Reservation  $rsv
     * @return mixed
     */
    public function view(User $user, Reservation  $rsv)
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
     * @param  \App\Models\Reservation  $rsv
     * @return mixed
     */
    public function update(User $user, Reservation  $rsv)
    {
        $clinic = $user->clinic;
        
        return $clinic && $clinic->id == $rsv->clinic_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reservation  $rsv
     * @return mixed
     */
    public function delete(User $user, Reservation  $rsv)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reservation  $rsv
     * @return mixed
     */
    public function restore(User $user, Reservation  $rsv)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reservation  $rsv
     * @return mixed
     */
    public function forceDelete(User $user, Reservation  $rsv)
    {
        //
    }

    public function get(User $user, Reservation  $rsv)
    {
        $clinic = $user->clinic;
        return $clinic && $clinic->id == $rsv->clinic_id;
    }
}
