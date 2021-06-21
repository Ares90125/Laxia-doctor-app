<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mtb_part_categories';

  protected $hidden = [
    'visible',
    'sort_no',
    'created_at',
    'updated_at'
  ];

  public function parent()
  {
    return $this->belongsTo(self::class, 'parent_id');
  }

  public function children()
  {
    return $this->hasMany(self::class, 'parent_id');
  }

  public function allChildren()
  {
    return $this->children()->with('allChildren');
  }

  public function descendantsAndSelf()
  {
      $categories = new Collection();
      $categories->push($this);
      foreach ($this->children as $item) {
          $categories->push($item);
          $categories = $categories->merge($item->descendantsAndSelf());
      }
      return $categories;
  }

  public function questions()
  {
    return $this->belongsToMany(Question::class, 'question_categories', 'category_id', 'question_id');
  }
}
