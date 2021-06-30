<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mtb_jobs';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
