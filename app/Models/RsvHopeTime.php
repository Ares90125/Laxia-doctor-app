<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RsvHopeTime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rsv_hope_times';
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'reservation_id',
      'date',
      'start_time',
      'end_time',
    ];
  
    protected $appends = [
      'hope_time'
    ];

    public function getHopeTimeAttribute()
    {
      return substr($this->start_time, 0, 5) . ' ~ ' . substr($this->end_time, 0, 5);
    }
}
