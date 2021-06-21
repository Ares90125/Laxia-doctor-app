<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorCaseImages extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'doctor_case_images';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'case_id',
    'type',
    'photo'
  ];

  protected $hidden = [
    'case_id',
    'updated_at',
    'created_at',
  ];
}
