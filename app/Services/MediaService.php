<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Media;
use DB;
use Auth;
use Throwable;

/**
 * Class MediaService
 * @package App\Services
 */
class MediaService
{
  public function store($attributes)
  {
    return Media::create($attributes);
  }
}
