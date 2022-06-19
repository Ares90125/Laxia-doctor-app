<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Doctor;
use App\Models\DoctorImages;
use App\Models\DoctorClinics;
use App\Models\Attachment;
use DB;
use Auth;
use Throwable;
use App\Models\ClinicDoctorsRelation;

/**
 * Class DoctorService
 * @package App\Services
 */
class DoctorService
{
  public function paginate($search) {
    $per_page = isset($search['per_page']) ? $search['per_page'] : 20;

    $query = Doctor::query();
    if (isset($search['q'])) {
      $query->where('name', 'LIKE', "%{$search['q']}%");
    }

    if (isset($search['favorite']) && $search['favorite'] == 1)
    {
      $currentUser = auth()->guard('doctor')->user();
      if (isset($currentUser) && isset($currentUser->doctor)) {
        $doctor_id = $currentUser->doctor->id;
        $query->whereIn('id', function($subquery) use ($doctor_id) {
          $subquery->select('favoriable_id')
            ->from('favorites')
            ->where('favoriable_type', 'App\Models\Doctor')
            ->where('doctor_id', $doctor_id);
        });
      }
    }

    if (isset($search['pref_id'])) {
      $query->where('pref_id', $search['pref_id']);
    }

    if (isset($search['city'])) {
      $query->where('addr01', 'LIKE', "%{$search['city']}%");
    }

    if (isset($search['orderby'])) {
      $orderby = $search['orderby'];
      if ($orderby == 'diaries_count') {
        $query->withCount('diaries')
          ->orderBy('diaries_count', 'DESC');
      }
      if ($orderby == 'rate') {
        $query->orderBy('ave_diaries_rate', 'DESC');
      }
    }

    return $query->paginate($per_page);
  }

  public function get($id)
  {
    return Doctor::with([
        'images',
        'clinics',
        'linkclinics'
      ])
      ->where('user_id', $id)
      ->firstOrFail();
  }

  // public function update($attributes, $where)
  // {
  //   $doctor = Doctor::where($where)->firstOrFail();
  //   $doctor->fill($attributes);
  //   $doctor->save();
  //   return $doctor;
  // }
  public function update($attributes, $where, $doctor_id = 0)
  {
    $doctor = Doctor::where($where)->firstOrFail();
    $doctor->fill($attributes);
    $doctor->save();

    if(isset($attributes['added_clinics']) && !empty($attributes['added_clinics'])) {
      foreach($attributes['added_clinics'] as $clinic_id) {
        $clinicDoctorRelationInfo = DoctorClinics::where(['clinic_id' => $clinic_id, 'doctor_id' => $doctor_id])
          ->first();

        if (!$clinicDoctorRelationInfo) {
          $clinicDoctorRelationInfo = DoctorClinics::create(['clinic_id' => $clinic_id, 'doctor_id' => $doctor_id]);
        }
      }
    }
    if (isset($attributes['imagesinfo'])) {
        $images = $attributes['imagesinfo'];
        if (isset($images['add'])) {
          for ($i = 0; $i < count($images['add']); $i++) {
            DoctorImages::create([
              'doctor_id' => $doctor_id,
              'photo' => $images['add'][$i]
            ]);
          }
        }

        if (isset($images['delete'])) {
          for ($i = 0; $i < count($images['delete']); $i++) {
            DoctorImages::where('id', $images['delete'][$i])
              ->where('doctor_id', $doctor_id)
              ->delete();
          }
        }
      }
    if(isset($attributes['deleted_clinics']) && !empty($attributes['deleted_clinics'])) {
      foreach($attributes['deleted_clinics'] as $clinic_id) {
        $clinicDoctorRelationInfo = DoctorClinics::where(['clinic_id' => $clinic_id, 'doctor_id' => $doctor_id])
          ->delete();
      }
    }

    return $doctor;
  }
}
