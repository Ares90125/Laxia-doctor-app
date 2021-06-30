<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'clinic_patient_info_memos';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'patient_info_id',
    'clinic_id',
    'memo',
  ];

  public function patient_info()
  {
    return $this->belongsTo(PatientInfo::class);
  }

  public function clinic()
  {
    return $this->belongsTo(Clinic::class);
  }
}
