<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'medias';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'mediable_type',
    'mediable_id',
    'type',
    'category',
    'path',
    'thumb_path',
    'user_id'
  ];

  public function mediable()
  {
    return $this->morphTo();
  }
}
