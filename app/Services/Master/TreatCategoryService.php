<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\TreatCategory;
use DB;
use Auth;
use Throwable;

/**
 * Class TreatCategoryService
 * @package App\Services\Master
 */
class TreatCategoryService
{
  public function toArray()
  {
    return TreatCategory::whereNull('parent_id')
      ->with('allChildren')
      ->get();
  }
}
