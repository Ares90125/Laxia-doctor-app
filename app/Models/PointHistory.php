<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
    protected $table = "point_histories";

    protected $fillable = [
        'patient_id',
        'title',
        'use_point',
        'type',
        'type_id'
    ];
}
