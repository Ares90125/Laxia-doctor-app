<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'attachments';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'attachable_type',
    'attachable_id',
    'path',
  ];
}
