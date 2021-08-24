<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Master\Pref;
use App\Models\Master\Job;
use App\Models\Master\Speciality;

class ClinicDoctorsRelation extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'clinic_doctors_relation';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'clinic_id',
    'doctor_id',
  ];

  protected $hidden = [
    'clinic_id',
    'created_at',
    'updated_at',
  ];

  protected $appends = [
    'firebase_key',
    'job_name',
    'spec0_name',
    'spec1_name',
    'spec2_name',
    'name',
    'email',
    'role',
    'm_clinic_id'
  ];

  public function getFirebaseKeyAttribute()
  {
    if ($this->user()->count()) {
      return $this->user()->first()->firebase_key;
    }
    return null;
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'doctor_id', 'id');
  }

  public function getNameAttribute()
  {
    return $this->user()->first()->name;
  }

  public function getEmailAttribute()
  {
    return $this->user()->first()->email;
  }

  public function getRoleAttribute()
  {
    return $this->user()->first()->role;
  }

  public function images()
  {
    return $this->morphMany(Attachment::class, 'attachable');
  }

  public function job()
  {
    return $this->belongsTo(Job::class, 'job_id');
  }

  public function getJobNameAttribute()
  {
    $job = $this->job()->where('id', $this->job_id)->first();
    return $job ? $job->name : null;
  }


  public function speciality0()
  {
    return $this->belongsTo(Speciality::class, 'spec0');
  }

  public function getSpec0NameAttribute()
  {
    $speciality = $this->speciality0()->where('id', $this->spec0)->first();
    return $speciality ? $speciality->name : null;
  }


  public function speciality1()
  {
    return $this->belongsTo(Speciality::class, 'spec1');
  }

  public function getSpec1NameAttribute()
  {
    $speciality = $this->speciality1()->where('id', $this->spec1)->first();
    return $speciality ? $speciality->name : null;
  }


  public function speciality2()
  {
    return $this->belongsTo(Speciality::class, 'spec2');
  }

  public function getSpec2NameAttribute()
  {
    $speciality = $this->speciality2()->where('id', $this->spec2)->first();
    return $speciality ? $speciality->name : null;
  }

  public function getMClinicIdAttribute() {
    return $this->clinic_id;
  }
}
