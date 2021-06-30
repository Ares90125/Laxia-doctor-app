<?php

namespace App\Models;

use App\Models\Master\Category;
use Illuminate\Database\Eloquent\Model;

class DoctorCaseCategoryRelation extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'doctor_case_category_relation';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'case_id',
    'category_id'
  ];

  protected $hidden = [
    'case_id',
    'updated_at',
    'created_at',
  ];

  protected $appends = [
    'category',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }

  public function getCategoryAttribute()
  {
    $category = $this->category()->first();
    if (assert($category)) {
      return $this->category()->first()->name;
    } else {
      return '';
    }
  }
}
