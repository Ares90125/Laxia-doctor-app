<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\TreatProgress;
use App\Models\Media;
use DB;
use Auth;
use Throwable;

/**
 * Class ProgressService
 * @package App\Services
 */
class ProgressService
{
  public function update($attributes, $where)
  {
    $progress = TreatProgress::where($where)->firstOrFail();

    $progressAttrs = Arr::get($attributes, 'progresses');
    $progress->update($progressAttrs);

    $progress->medias()->delete();
    $mediaAttrs = Arr::get($attributes, 'medias');
    foreach ($mediaAttrs as $id)
    {
      $media = Media::find($id);
      if (!$media) continue;
      $progress->medias()->save($media);
    }

    $progress->statuses()->sync([]);
    $statusAttrs = Arr::get($attributes, 'status');
    foreach ($statusAttrs as $key => $value)
    {
      $progress->statuses()->attach($key, ['value' => $value]);
    }

    return $progress->load([
      'medias',
      'statuses'
    ]);
  }
}
