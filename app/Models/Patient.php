<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Category;
use App\Models\Master\Pref;
use Carbon\Carbon;

class Patient extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'patients';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'kana',
    'gender',
    'phone_number',
    'birthday',
    'unique_id',
    'nickname',
    'intro',
    'area_id',
    'photo',
    'point'
  ];

  protected $appends = [
    'firebase_key',
    'age',
    'area',
    'follows_count',
    'followers_count',
    'is_follow',
  ];

  public function getFirebaseKeyAttribute()
  {
    if ($this->user()->count()) {
      return $this->user()->first()->firebase_key;
    }
    return '';
  }

  public function getAgeAttribute()
  {
    if ($this->birthday) {
      return Carbon::parse($this->birthday)->age;
    }
    return null;
  }

  public function getFollowsCountAttribute()
  {
    return $this->follows()->count();
  }

  public function getFollowersCountAttribute()
  {
    return $this->followers()->count();
  }

  public function getIsFollowAttribute()
  {
    $currentUser = auth()->guard('patient')->user();
    if (!$currentUser || $currentUser->role == \App\Enums\User\Type::CLINIC) return false;
    $patient = $currentUser->patient;
    if (!$patient) return false;
    return $patient->follows->contains($this);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function info()
  {
    return $this->hasOne(PatientInfo::class);
  }

  public function categories()
  {
    return $this->belongsToMany(Category::class, 'patient_categories', 'patient_id', 'category_id');
  }

  public function follows()
  {
    return $this->belongsToMany(self::class, 'follows', 'patient_id', 'follow_id');
  }

  public function followers()
  {
    return $this->belongsToMany(self::class, 'follows', 'follow_id', 'patient_id');
  }

  public function diaries()
  {
    return $this->hasMany(Diary::class);
  }

  public function counselings()
  {
    return $this->hasMany(CounselingReport::class);
  }

  public function questions()
  {
    return $this->hasMany(Question::class);
  }

  public function favoriteDiaries()
  {
    return $this->morphedByMany(Diary::class, 'favoriable', 'favorites');
  }

  public function area()
  {
    return $this->belongsTo(Pref::class, 'area_id');
  }

  public function getAreaAttribute()
  {
    if ($this->area()->count()) {
      return $this->area()->first()->name;
    }
    return null;
  }
}
