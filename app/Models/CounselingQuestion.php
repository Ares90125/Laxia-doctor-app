<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingQuestion extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'counseling_questions';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'counseling_report_id',
    'question',
    'answer'
  ];

  public function counseling()
  {
    return $this->belongsTo(CounselingReport::class);
  }
}
