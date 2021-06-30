<?php

namespace App\Traits;

trait Sort
{
    public function scopeSort($query)
    {
        return $query->orderby('sort_no', 'ASC');
    }
}
