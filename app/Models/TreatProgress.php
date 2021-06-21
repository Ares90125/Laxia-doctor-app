<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\TreatIndicator;

class TreatProgress extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'treat_progresses';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'diary_id',
    'from_treat_day',
    'content',
  ];

  public function diary()
  {
    return $this->belongsTo(Diary::class);
  }

  public function medias()
  {
    return $this->morphMany(Media::class, 'mediable');
  }

  public function statuses()
  {
    return $this->belongsToMany(TreatIndicator::class, 'treat_status', 'progress_id', 'indicator_id')
      ->withPivot('value');
  }

  public function comments()
  {
    return $this->morphMany(Comment::class, 'commentable');
  }

  public function comments_limit50()
  {
    return $this->morphMany(Comment::class, 'commentable')
      ->with('allChildren')
      ->whereNull('parent_id')
      ->latest()
      ->take(50);
  }
}
