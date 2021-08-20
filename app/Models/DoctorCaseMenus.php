<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorCaseMenus extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'doctor_case_menus';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'case_id',
    'menu_id',
    'name',
    'cost'
  ];

  protected $hidden = [
    'case_id',
    'menu_id',
    'updated_at',
    'created_at',
  ];
}
