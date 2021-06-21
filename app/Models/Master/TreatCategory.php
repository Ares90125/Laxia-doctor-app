<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Patient;

class TreatCategory extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mtb_interest_categories';

  protected $hidden = [
    'sort_no',
    'visible',
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

  public function patients()
  {
    return $this->belongsToMany(Patient::class, 'patient_interest_categories', 'interest_category_id', 'patient_id');
  }
}
