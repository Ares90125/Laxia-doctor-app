<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'comments';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'patient_id',
    'parent_id',
    'commentable_type',
    'commentable_id',
    'comment',
  ];

  protected $hidden = [
    'commentable_type',
    'commentable_id',
  ];

  protected $appends = [
    'patient_nickname',
    'patient_photo',
  ];

  public function getPatientNickNameAttribute()
  {
    if ($this->owner()->count()) {
      return $this->owner()->first()->nickname;
    }
    return null;
  }

  public function getPatientPhotoAttribute()
  {
    if ($this->owner()->count()) {
      return $this->owner()->first()->photo;
    }
    return null;
  }

  public function owner()
  {
    return $this->belongsTo(Patient::class, 'patient_id');
  }

  public function commentable()
  {
    return $this->morphTo();
  }

  public function parent()
  {
      return $this->belongsTo(self::class, 'parent_id');
  }

  public function children()
  {
      return $this->hasMany(self::class, 'parent_id');
  }

  public function allChildren()
  {
    return $this->children()->with('allChildren');
  }

  public function comments()
  {
      return $this->children()->with([
          'comments',
      ]);
  }

}
