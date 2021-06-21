<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mtb_cities';

  public function towns()
  {
    return $this->hasMany(Town::class, 'city_id');
  }
}
