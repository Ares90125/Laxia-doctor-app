<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Category;
use App\Models\Master\TreatCategory;
use App\Enums\User\Type as UserType;
use DateTime;

class Question extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'questions';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'patient_id',
    'title',
    'content',
  ];

  protected $appends = [
    'views_count',
    'comments_count',
    'likes_count',
    'is_like',
    // 'favoriters_count',
    'is_favorite',
    'answers',
    'before_time'
  ];

  public function viewers()
  {
    return $this->morphToMany(Patient::class, 'viewable', 'viewables','viewable_id', 'patient_id');
  }

  public function getViewsCountAttribute()
  {
    return $this->viewers()->count();
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
      ->orderBy('created_at', 'DESC')
      ->limit(50);
  }

  public function getCommentsCountAttribute()
  {
    // return $this->comments()->count();
    return $this->answer()->count();
  }

  // いいめ
  public function likers()
  {
      return $this->morphToMany(Patient::class, 'likeable');
  }

  public function getLikesCountAttribute()
  {
    return $this->likers()->count();
  }

  public function getIsLikeAttribute()
  {
    $currentUser = auth()->guard('patient')->user();
    if (!$currentUser) return false;
    if ($currentUser->role != UserType::USER) return false;
    $likerIds = $this->likers()
      ->get()
      ->pluck('id')
      ->toArray();
    return in_array($currentUser->patient->id, $likerIds);
  }

  public function owner()
  {
    return $this->belongsTo(Patient::class, 'patient_id', 'id');
	}
	
	public function medias()
	{
		return $this->morphMany(Media::class, 'mediable');
  }
  
  public function categories()
  {
    // return $this->belongsToMany(Category::class, 'question_categories', 'question_id', 'category_id');
    return $this->belongsToMany(TreatCategory::class, 'question_categories', 'question_id', 'category_id');
  }

  public function favoriters()
  {
    return $this->morphToMany(Patient::class, 'favoriable', 'favorites');
  }

  public function getFavoritersCountAttribute()
  {
    return $this->favoriters()->count();
  }

  public function getIsFavoriteAttribute()
  {
    $currentUser = auth()->guard('patient')->user();
    if (!$currentUser || !($currentUser->patient)) return 'xx';
    $favoriterIds = $this->favoriters()
      ->get()
      ->pluck('id')
      ->toArray();
    return in_array($currentUser->patient->id, $favoriterIds);
  }

  public function answer()
  {
    return $this->hasMany(Answers::class, 'question_id', 'id')->orderBy('answers.updated_at', 'desc');
  }

  public function getAnswersAttribute()
  {
    return $this->answer()->get();
  }

  public function getBeforeTimeAttribute() {
    $current_time = new DateTime('now');
    $created_time = new DateTime($this->created_at);

    // $dteDiff  = $created_time->diff($current_time); 
    
    // // return $dteDiff->format("%H時間 %I分 %S秒前");
    // return $dteDiff->format("%h時間 %i分前");

    $secDiff = $current_time->getTimestamp() - $created_time->getTimestamp();
    $dteDiff  = $created_time->diff($current_time);

    $val = '';

    if($secDiff < 60)
      $val = "1分以内";
    elseif($secDiff < 60 * 59)
      $val = $dteDiff->format("%i分前");
    elseif($secDiff < 24 * 60 * 60)
      $val = $dteDiff->format("%h時間前");
    elseif($current_time->format('Y') == $created_time->format('Y')) {
      $val = $created_time->format('m月d日');
    } else {
      $val = $created_time->format('Y年m月d日');
    }

    return $val;
  }
}
