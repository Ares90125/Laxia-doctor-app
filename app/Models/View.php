<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'views';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'patient_id',
    'viewable_type',
    'viewable_id'
  ];

  public function viewable()
  {
    return $this->morphTo();
  }
}
