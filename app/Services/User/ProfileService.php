<?php
namespace App\Services\User;

use Illuminate\Support\Arr;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Attachment;
use DB;
use Auth;
use Throwable;

/**
 * Class ProfileService
 * @package App\Services\User
 */
class ProfileService
{ 
  public function update($attributes, $where)
  {
    $patientAttrs = Arr::get($attributes, 'patients');
    $patient = Patient::updateOrCreate(
      $where,
      $patientAttrs
    );
    
    $categories = Arr::get($attributes, 'patient_categories');
    $patient->categories()->sync($categories);

    return $patient;
  }
}
