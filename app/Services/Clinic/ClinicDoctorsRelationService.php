<?php
namespace App\Services\Clinic;

use Illuminate\Support\Arr;
use App\Models\ClinicDoctorsRelation;
use App\Models\Doctor;
use App\Models\Attachment;
use App\Enums\User\Type as UserType;
use DB;
use Auth;
use Throwable;

/**
 * Class ClinicDoctorsRelationService
 * @package App\Services
 */
class ClinicDoctorsRelationService
{
  public function add($clinic_id, $doctor_id) {
    
    $clinicDoctorRelationInfo = ClinicDoctorsRelation::where(['clinic_id' => $clinic_id, 'doctor_id' => $doctor_id])
      ->first();

    if (!$clinicDoctorRelationInfo) {
      $clinicDoctorRelationInfo = ClinicDoctorsRelation::create(['clinic_id' => $clinic_id, 'doctor_id' => $doctor_id]);
    }

    return $clinicDoctorRelationInfo->id;
  }

  public function get($clinic_id) {
    $query = ClinicDoctorsRelation::where('clinic_id', $clinic_id)
      ->join('doctors', 'doctors.doctor_id', '=', 'clinic_doctors_relation.doctor_id')
      ->get();
    return $query;
  }

  public function delete($clinic_id, $doctor_id) {
    $clinicDoctorRelationInfo = ClinicDoctorsRelation::where(['clinic_id' => $clinic_id, 'doctor_id' => $doctor_id]);
    $clinicDoctorRelationInfo->delete();
    return true;
  }
}
