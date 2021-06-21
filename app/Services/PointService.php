<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\PointHistory;
use DB;
use Auth;
use Throwable;

/**
 * Class PointService
 * @package App\Services
 */
class PointService
{
  public function paginate($where)
  {
    return PointHistory::where($where)
      ->paginate(25);
  }
}
