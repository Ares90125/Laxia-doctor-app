<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\Job;
use DB;
use Auth;
use Throwable;

/**
 * Class JobService
 * @package App\Services\Master
 */
class JobService
{
  public function toArray()
  {
    return Job::all()->pluck('name', 'id')->toArray();
  }
}
