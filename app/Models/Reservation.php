<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\RsvContent;
use App\Models\Master\TreatCategory;

class Reservation extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'reservations';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'visit_date',
    'start_time',
    'end_time',
    'patient_info_id',
    'clinic_id',
    'stuff_id',
    'rsv_content_id',
    'menu_id',
    'status',
    'source',
    'hope_treat',
    'is_visited',
    'note',
    'use_point'
  ];

  protected $appends = [
    'visit_time'
  ];

  public function getVisitTimeAttribute()
  {
    return substr($this->start_time, 0, 5) . ' ~ ' . substr($this->end_time, 0, 5);
  }

  public function hopeTimes()
  {
    return $this->hasMany(RsvHopeTime::class);
  }

  public function patient_info()
  {
    return $this->belongsTo(PatientInfo::class);
  }

  public function clinic()
  {
    return $this->belongsTo(Clinic::class);
  }

  public function stuff()
  {
    return $this->belongsTo(Stuff::class);
  }

  public function menu()
  {
    return $this->belongsTo(Menu::class);
  }

  public function rsv_content()
  {
    return $this->belongsTo(RsvContent::class);
  }

  public function payment()
  {
    return $this->hasOne(Payment::class);
  }

  public function mailbox()
  {
    return $this->hasOne(Mailbox::class);
  }

  public function hopeCategories()
  {
    return $this->belongsToMany(TreatCategory::class, 'reservation_categories', 'reservation_id', 'category_id');
  }
}
