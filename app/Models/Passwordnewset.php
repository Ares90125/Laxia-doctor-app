<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passwordnewset extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'password_newset';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'type_id',
    'token'
  ];

}
