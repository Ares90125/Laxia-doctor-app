<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Pref;

class Clinic extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'clinics';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'kana',
    'pref_id',
    'addr01',
    'addr02',
    'department',
    'net_reservation',
    'nearest_station',
    'site',
    'access',
    'phone_number',
    'working_time',
    'credit_card',
    'holidays',
    'parking',
    'company_title',
    'company_profile',
    'parking',
    'photo',
    'ave_diaries_rate',
  ];

  protected $appends = [
    'firebase_key',
    'diaries_count',
    'counselings_count',
    'menus_count',
    'stuffs_count',
    // 'ave_diaries_rate',
    // 'favoriters_count',
    'is_favorite',
    'address',
    'user_name',
    'email',
    'role',
  ];

  public function getFirebaseKeyAttribute()
  {
    if ($this->user()->count()) {
      return $this->user()->first()->firebase_key;
    }
    return null;
  }

  public function getDiariesCountAttribute()
  {
    return $this->diaries()->count();
  }

  public function getCounselingsCountAttribute()
  {
    return $this->counselings()->count();
  }

  public function getMenusCountAttribute()
  {
    return $this->menus()->count();
  }

  public function getStuffsCountAttribute()
  {
    return $this->stuffs()->count();
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function getUserNameAttribute()
  {
    return $this->users()->first()->name;
  }

  public function getEmailAttribute()
  {
    return $this->users()->first()->email;
  }

  public function getRoleAttribute()
  {
    return $this->users()->first()->role;
  }


  public function images()
  {
    return $this->morphMany(Attachment::class, 'attachable');
  }

  public function memos()
  {
    return $this->belongsToMany(Memo::class);
  }

  public function cases()
  {
    return $this->hasMany(TreatCase::class);
  }

  public function pref()
  {
    return $this->belongsTo(Pref::class);
  }

  public function diaries()
  {
    return $this->hasMany(Diary::class);
  }

  public function diaries_limit2()
  {
    return $this->hasMany(Diary::class)
      ->orderby('diaries.updated_at', 'desc')
      ->limit(2);
  }

  public function counselings()
  {
    return $this->hasMany(CounselingReport::class);
  }

  public function counselings_limit2()
  {
    return $this->hasMany(CounselingReport::class)
      ->orderby('counseling_reports.updated_at', 'desc')
      ->limit(2);
  }

  public function menus()
  {
    return $this->hasMany(Menu::class);
  }

  public function menus_limit2()
  {
    return $this->hasMany(Menu::class)
      ->orderby('menus.updated_at', 'desc')
      ->limit(2);
  }

  public function stuffs()
  {
    return $this->hasMany(Stuff::class);
  }

  public function stuffs_limit4()
  {
    return $this->hasMany(Stuff::class)
      ->orderby('stuffs.updated_at', 'desc')
      ->limit(4);
  }

  // public function getAveDiariesRateAttribute()
  // {
  //   $i = 0; $sum = 0;
  //   foreach ($this->diaries()->get() as $diary)
  //   {
  //     if ($diary->ave_rate) {
  //       $i++;
  //       $sum += $diary->ave_rate;
  //     }
  //   }
  //   if ($i == 0) return null;
  //   return round($sum/$i, 1);
  // }

  public function favoriters()
  {
    return $this->morphToMany(Patient::class, 'favoriable', 'favorites');
  }

  public function getFavoritersCountAttribute()
  {
    return $this->favoriters()->count();
  }

  public function getIsFavoriteAttribute()
  {
    $currentUser = auth()->guard('patient')->user();
    if (!$currentUser || !($currentUser->patient)) return false;
    $favoriterIds = $this->favoriters()
      ->get()
      ->pluck('id')
      ->toArray();
    return in_array($currentUser->patient->id, $favoriterIds);
  }

  public function getAddressAttribute()
  {
    $pref = $this->pref()->count() ? $this->pref()->first()->name: '';
    return "{$pref}{$this->addr01}{$this->addr02}{$this->department}";
  }
}
