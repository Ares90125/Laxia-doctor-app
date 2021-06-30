<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\PatientInfo;
use App\Models\Reservation;
use App\Models\Patient;
use DB;
use Auth;
use Throwable;

/**
 * Class PatientService
 * @package App\Services
 */
class PatientService
{
  public function paginate($params)
  {
    $per_page = isset($params['per_page']) ? $params['per_page'] : 20;
    
    $query = Patient::query();

    $currentUser = auth()->user();
    if ($currentUser->paitent) {
      $query->where('id', '<>', $currentUser->patient->id);
    }

    if (isset($params['q'])) {
      $query->where('name', 'LIKE', "%{$params['q']}%");
    }

    return $query->paginate($per_page);
  }
  

  public function toggleFollow($cPatientId, $id)
  {
    $patient = Patient::find($cPatientId);
    return $patient->follows()->toggle($id);
  }
  
  public function getFollows($params)
  {
    $per_page = isset($params['per_page']) ? $params['per_page'] : 20;
    $patientId = $params['patient_id'];
    return Patient::whereIn('id', function($subquery) use ($patientId) {
        $subquery->select('follow_id')
          ->from('follows')
          ->where('patient_id', $patientId);
      })->paginate($per_page);
  }
  
  public function getFollowers($params)
  {
    $per_page = isset($params['per_page']) ? $params['per_page'] : 20;
    $patientId = $params['follow_id'];
    return Patient::whereIn('id', function($subquery) use ($patientId) {
        $subquery->select('patient_id')
          ->from('follows')
          ->where('follow_id', $patientId);
      })->paginate($per_page);
  }
}
