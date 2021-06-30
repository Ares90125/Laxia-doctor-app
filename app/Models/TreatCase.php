<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Speciality;
use App\Models\Master\Category;

class TreatCase extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cases';
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'clinic_id',
      'menu_id',
      'stuff_id',
      'patient_age',
      'patient_gender',
      'case_description',
      'treat_risk',
      'before_photo',
      'after_photo',
    ];

    protected $appends = [
      'views_count',
      'comments_count',
      'likes_count',
      'is_like',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'case_categories', 'case_id', 'category_id');
    }

    public function stuff()
    {
        return $this->belongsTo(Stuff::class);
    }

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

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
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
        if (!$currentUser || !isset($currentUser->patient)) return false;
        $likerIds = $this->likers()
        ->get()
        ->pluck('id')
        ->toArray();
        return in_array($currentUser->patient->id, $likerIds);
    }
}
