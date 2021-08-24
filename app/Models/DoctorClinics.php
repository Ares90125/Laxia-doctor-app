<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorClinics extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'doctor_clinics';
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'doctor_id',
    'clinic_id',
  ];

  protected $hidden = [

  ];

  protected $appends = [

  ];

}