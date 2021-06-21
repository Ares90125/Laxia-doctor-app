<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\ConcernCategory;
use DB;
use Auth;
use Throwable;

/**
 * Class ConcernCategoryService
 * @package App\Services\Master
 */
class ConcernCategoryService
{
  public function toArray()
  {
    return ConcernCategory::whereNull('parent_id')
      ->with('allChildren')
      ->get();
  }
}
