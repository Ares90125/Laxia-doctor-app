<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\PatientInfo;
use App\Models\Reservation;
use DB;
use Auth;
use Throwable;

/**
 * Class PatientInfoService
 * @package App\Services
 */
class PatientInfoService
{
  public function paginate($search)
  {
    $per_page = isset($search['per_page']) ? $search['per_page'] : 20;

    $query = PatientInfo::query();
    
    if (isset($search['clinic_id'])) {
      $clinicId = $search['clinic_id'];
      $query->whereIn('id', function($subquery) use ($clinicId) {
        $subquery->select('patient_info_id')
          ->from(with(new Reservation)->getTable())
          ->where('clinic_id', $clinicId);
      });
    }

    $query->orderby('created_at', 'desc');

    return $query->paginate($per_page);
  }

  public function get($id)
  {
    return PatientInfo::findOrFail($id);
  }

  public function store($attributes, $where)
  {
    $infoAttrs = Arr::get($attributes, 'info');
    
    $data = array_merge($infoAttrs, $where);

    return PatientInfo::updateOrCreate($where, $data);
  }

  public function update($attributes, $where)
  {
    $patientInfoAttrs = Arr::get($attributes, 'patientInfos');
    $patientInfo = PatientInfo::where($where)
      ->firstOrFail();
    $patientInfo->fill($patientInfoAttrs);
    $patientInfo->save();

    $patientInfo->memos()
      ->updateOrCreate(
        [
          'patient_info_id' => $patientInfo->id,
          'clinic_id' => auth()->guard('clinic')->user()->clinic->id
        ], 
        [
          'memo' => $attributes['memo']
        ]
      );

    return $patientInfo;
  }
}
