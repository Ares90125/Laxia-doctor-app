<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\User\Type as UserType;
use Carbon\Carbon;

class PatientInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient_infos';
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'patient_id',
      'name01',
      'name02',
      'kana01',
      'kana02',
      'gender',
      'phone_number',
      'birthday'
    ];

    protected $appends = [
      'age',
      'name',
      'kana',
      'memo',
      'firebase_key',
      'user_id'
    ];
 
    public function getAgeAttribute()
    {
        if ($this->birthday) {
            return Carbon::parse($this->birthday)->age;
        }
        return '';
    }

    public function getMemoAttribute()
    {
      $currentUser = auth()->guard('api')->user();
      if (!$currentUser || $currentUser->role != UserType::CLINIC) return '';
      $memo = $this->memos()
        ->where('clinic_id', $currentUser->id)
        ->first();
      if ($memo) return $memo->memo;
      return '';
    }
 
    public function getFirebaseKeyAttribute()
    {
        if ($this->patient()->count()) {
            return $this->patient()->first()->firebase_key;
        }
        return '';
    }
 
    public function getUserIdAttribute()
    {
        if ($this->patient()->count()) {
            return $this->patient()->first()->user_id;
        }
        return '';
    }

    public function patient()
    {
      return $this->belongsTo(Patient::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }

    public function getKanaAttribute()
    {
      return $this->kana01 . " " . $this->kana02;
    }

    public function getNameAttribute()
    {
      return $this->name01 . " " . $this->name02;
    }

    public function memos()
    {
      return $this->hasMany(Memo::class, 'patient_info_id', 'id');
    }
}
