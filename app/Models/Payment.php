<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'payments';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'reservation_id',
    'total_price',
    'except_price',
    'except_item',
    'treat_price'
  ];

  public function reservation()
  {
    return $this->belongsTo(Reservation::class);
  }
}
