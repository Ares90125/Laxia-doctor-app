<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Master\Category;
use App\Models\Question;
use App\Models\Media;
use DB;
use Auth;
use Throwable;

/**
 * Class QuestionService
 * @package App\Services
 */
class QuestionService
{
  public function paginate($search)
  {
    $per_page = isset($search['per_page']) ? $search['per_page'] : 20;
    $query = Question::query()
      ->with([
        'owner',
        'medias',
        'categories'
      ]);

    if (isset($search['category_id']))
    {
      $ids = $search['category_id'];
      $query->whereHas('categories', function($subquery) use ($ids) {
        $subquery->whereIn('question_categories.category_id', $ids);
      });
    }

    if (isset($search['orderby'])) {
      $orderby = $search['orderby'];
      if ($orderby == 'comments_count') {
        $query->withCount('comments')
          ->orderby('comments_count', 'DESC');
      } else if ($orderby == 'news') {
        $query->orderby('updated_at', 'DESC');
      }
    } else {
      $query->orderby('updated_at', 'desc');
    }

    return $query->paginate($per_page);
  }

  public function get($id)
  {
    return Question::findOrFail($id);
  }

  public function addAnswer($attributes, $addtional = [])
  {
    $menuAttrs = Arr::get($attributes, 'questions');
    $cateArr = Arr::get($attributes, 'categories');
    $mediaArr = Arr::get($attributes, 'medias');
    $data = array_merge($menuAttrs, $addtional);
    $question = Question::create($data);
    
    $question->categories()->sync($cateArr);
    
    foreach ($mediaArr as $id)
    {
      $media = Media::find($id);
      if (!$media) continue;
      $question->medias()->save($media);
    }

    return $question->load(['categories', 'medias']);
  }

  public function getAnswers($attributes, $where)
  {
  }

  public function deleteAnswers($attributes, $where)
  {
  }
}
