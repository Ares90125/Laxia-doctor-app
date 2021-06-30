<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Pref extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mtb_prefs';

  public function cities()
  {
    return $this->hasMany(City::class, 'pref_id');
  }
}
