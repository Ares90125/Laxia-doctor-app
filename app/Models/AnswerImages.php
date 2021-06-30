<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class AnswerImages extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'answer_images';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'answer_id',
    'photo',
  ];

  protected $hidden = [
    'answer_id',
    'updated_at',
    'created_at',
  ];
}
