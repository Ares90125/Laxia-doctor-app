<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\Category;
use DB;
use Auth;
use Throwable;

/**
 * Class CategoryService
 * @package App\Services\Master
 */
class CategoryService
{
  public function toArray()
  {
    return Category::whereNull('parent_id')
      ->with('allChildren')
      ->get();
  }
}
