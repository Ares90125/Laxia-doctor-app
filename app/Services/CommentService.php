<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Patient;
use DB;
use Auth;
use Throwable;

/**
 * Class CommentService
 * @package App\Services
 */
class CommentService
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

  public function store($attributes, $commentable, $additional = [])
  {
    $commentAttrs = Arr::get($attributes, 'comments');
    $commentAttrs = array_merge($commentAttrs, $additional);

    $comment = $commentable->comments()->create($commentAttrs);

    return $comment;
  }
}
