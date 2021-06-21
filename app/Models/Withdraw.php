<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'withdraws';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'clinic_id',
    'month',
    'price',
    'tax',
    'system_fee',
    'paid_at'
  ];

  protected $appends = [
    'total'
  ];

  public function getTotalAttribute()
  {
      return floor($this->price * $this->tax / 100) + $this->system_fee;
  }
}
