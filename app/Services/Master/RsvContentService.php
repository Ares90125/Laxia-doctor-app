<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\RsvContent;
use DB;
use Auth;
use Throwable;

/**
 * Class RsvContentService
 * @package App\Services\Master
 */
class RsvContentService
{
  public function toArray()
  {
    return RsvContent::all()->pluck('name', 'id')->toArray();
  }
}
