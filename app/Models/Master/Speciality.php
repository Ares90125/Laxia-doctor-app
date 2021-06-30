<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mtb_specialities';

  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
