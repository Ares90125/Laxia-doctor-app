<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\DoctorCaseImages;
use App\Models\DoctorCaseMenus;
use App\Models\DoctorCaseCategoryRelation;
use Illuminate\Database\Eloquent\Model;

class DoctorCases extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'doctor_cases';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'doctor_id',
    'title',
    'age',
    'gender',
    'operation',
    'operationRisk',
    'majordoctorComment',
  ];

  protected $hidden = [
    'updated_at',
  ];

  protected $appends = [
    'menuProperty',
    'before',
    'after',
    'category',
    'doctor'
  ];

  public function doctor()
  {
    return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
  }

  public function getDoctorAttribute()
  {
    return $this->doctor()->first();
  }


  public function caseImages()
  {
    return $this->hasMany(DoctorCaseImages::class, 'case_id', 'id');
  }

  public function getBeforeAttribute()
  {
    return $this->caseImages()->where('type', 'before')->get();
  }

  public function getAfterAttribute()
  {
    return $this->caseImages()->where('type', 'after')->get();
  }


  public function caseMenus()
  {
    return $this->hasMany(DoctorCaseMenus::class, 'case_id', 'id');
  }

  public function getMenuPropertyAttribute()
  {
    return $this->caseMenus()->get();
  }


  public function category()
  {
    return $this->hasMany(DoctorCaseCategoryRelation::class, 'case_id', 'id');
  }

  public function getCategoryAttribute()
  {
    return $this->category()->get();
  }
}
