<?php
namespace App\Services\Doctor;

use Illuminate\Support\Arr;
use App\Models\Answers;
use App\Models\AnswerImages;
use DB;
use Auth;
use Throwable;

/**
 * Class CommentService
 * @package App\Services
 */
class AnswerService
{
  public function paginate($params, $commentable)
  {
    $per_page = $params['per_page'] ?? 50;

    return $commentable->comments()
      ->with('allChildren')
      ->whereNull('parent_id')
      ->orderBy('created_at', 'DESC')
      ->paginate($per_page);
  }

  public function get($id)
  {
    return Doctor::with([
        'images',
      ])
      ->where('doctor_id', $id)
      ->firstOrFail();
  }

  public function store($attributes, $question_id, $doctor_id)
  {
    $answer = Answers::create([
      'question_id' => $question_id,
      'doctor_id' => $doctor_id,
      'answer' => $attributes['answer']
    ]);

    if (isset($attributes['photo'])) {
      for ($i = 0; $i < count($attributes['photo']); $i++) {
        AnswerImages::create([
          'answer_id' => $answer->id,
          'photo' => $attributes['photo'][$i]
        ]);
      }
    }
    
    return $answer;
  }

  public function delete($question_id, $doctor_id, $answer_id)
  {
    $answer = Answers::where('id', $answer_id)
      ->where('doctor_id', $doctor_id)
      ->where('question_id', $question_id)
      ->first();

    if (!isset($answer)) {
      return false;
    }
    $answerImages = AnswerImages::where('answer_id', $answer->id)->delete();
    $answer->delete();
    return true;
  }

  public function update($attributes, $question_id, $doctor_id, $answer_id)
  {
    $answer = Answers::where([
      'question_id' => $question_id,
      'doctor_id' => $doctor_id,
      'answer' => $attributes['answer']
    ]);

    $answer = Answers::where('id', $answer_id)
      ->where('doctor_id', $doctor_id)
      ->where('question_id', $question_id)
      ->firstOrFail();

    $answer->fill($attributes);
    $answer->save();

    if (isset($attributes['deleted_photo'])) {
      for ($i = 0; $i < count($attributes['deleted_photo']); $i++) {
        $answerImage = AnswerImages::where('id', $attributes['deleted_photo'][$i])
          ->where('answer_id', $answer_id)
          ->delete();
      }
    }

    if (isset($attributes['added_photo'])) {
      for ($i = 0; $i < count($attributes['added_photo']); $i++) {
        AnswerImages::create([
          'answer_id' => $answer->id,
          'photo' => $attributes['added_photo'][$i]
        ]);
      }
    }
    
    return $answer;
  }
}
