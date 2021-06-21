<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PatientInfo;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientInfoPolicy
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
     * @param  \App\Models\PatientInfo  $patientInfo
     * @return mixed
     */
    public function view(User $user, PatientInfo $patientInfo)
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
     * @param  \App\Models\PatientInfo  $patientInfo
     * @return mixed
     */
    public function update(User $user, PatientInfo $patientInfo)
    {
        return $this->canEdit($user, $patientInfo);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientInfo  $patientInfo
     * @return mixed
     */
    public function delete(User $user, PatientInfo $patientInfo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientInfo  $patientInfo
     * @return mixed
     */
    public function restore(User $user, PatientInfo $patientInfo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientInfo  $patientInfo
     * @return mixed
     */
    public function forceDelete(User $user, PatientInfo $patientInfo)
    {
        //
    }

    public function get(User $user, PatientInfo $patientInfo)
    {
        return $this->canEdit($user, $patientInfo);
    }

    private function canEdit($user, $patientInfo)
    {
        $clinic = $user->clinic;
        
        if (!$clinic) return false;

        $rsvCount = Reservation::where([
            'clinic_id' => $clinic->id,
            'patient_info_id' => $patientInfo->id
        ])->count();
        
        if ($rsvCount) {
            return true;
        }
        return false;
    }
}
