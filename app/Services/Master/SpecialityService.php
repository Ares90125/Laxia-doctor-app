<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\Speciality;
use DB;
use Auth;
use Throwable;

/**
 * Class JobService
 * @package App\Services\Master
 */
class SpecialityService
{
  public function toArray()
  {
    return Speciality::all()->pluck('name', 'id')->toArray();
  }
}
