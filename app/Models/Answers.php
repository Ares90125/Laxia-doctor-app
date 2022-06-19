<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\AnswerImages;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Answers extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'answers';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'question_id',
    'doctor_id',
    'answer',
  ];

  protected $hidden = [
    // 'updated_at',
    // 'created_at',
  ];

  protected $appends = [
    'doctor',
    'photos',
    'update_time'
  ];

  public function doctor()
  {
    return $this->belongsTo(Doctor::class, 'doctor_id', 'user_id');
  }

  public function getDoctorAttribute()
  {
    return $this->doctor()->first();
  }

  public function answerImages()
  {
    return $this->hasMany(AnswerImages::class, 'answer_id', 'id');
  }

  public function getPhotosAttribute()
  {
    return $this->answerImages()->get();
  }

  public function getUpdateTimeAttribute() {
    $current_time = new DateTime('now');
    $updated_time = new DateTime($this->updated_at);

    // $dteDiff  = $updated_time->diff($current_time);

    // // return $dteDiff->format("%H時間 %I分 %S秒前");
    // return $dteDiff->format("%h時間 %i分前");

    $secDiff = $current_time->getTimestamp() - $updated_time->getTimestamp();
    $dteDiff  = $updated_time->diff($current_time);

    $val = '';

    if($secDiff < 60)
      $val = "1分以内";
    elseif($secDiff < 60 * 59)
      $val = $dteDiff->format("%i分前");
    elseif($secDiff < 24 * 60 * 60)
      $val = $dteDiff->format("%h時間前");
    elseif($current_time->format('Y') == $updated_time->format('Y')) {
      $val = $updated_time->format('m月d日');
    } else {
      $val = $updated_time->format('Y年m月d日');
    }

    return $val;
  }
}
