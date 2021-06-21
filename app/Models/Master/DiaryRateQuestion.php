<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DiaryRateQuestion extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mtb_diary_rate_questions';

  protected $hidden = [
    'visible',
    'sort',
    'created_at',
    'updated_at',
  ];
}
