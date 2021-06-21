<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Stuff;
use DB;
use Auth;
use Throwable;

/**
 * Class StuffService
 * @package App\Services
 */
class StuffService
{
  public function paginate($search)
  {
    $per_page = isset($search['per_page']) ? $search['per_page'] : 20;
    $query = Stuff::query()
      ->with(['job', 'specialities']);
    if (isset($search['clinic_id'])) {
      $query->where('clinic_id', $search['clinic_id']);
    }
    $query->orderby('created_at', 'desc');
    return $query->paginate($per_page);
  }

  public function toArray($params)
  {
    $query = Stuff::query();
    if (isset($params['clinic_id'])) {
      $query->where('clinic_id', $params['clinic_id']);
    }
    $query->orderby('created_at', 'desc');
    return $query->get()
      ->pluck('name', 'id')
      ->toArray();
  }

  public function get($id)
  {
    return Stuff::findOrFail($id);
  }

  public function store($attributes, $addtional = [])
  {
    $stuffAttrs = Arr::get($attributes, 'stuffs');
    $specialitiesAttrs = Arr::get($attributes, 'specialities');
    
    $data = array_merge($stuffAttrs, $addtional);
    $stuff = Stuff::create($data);
    if ($specialitiesAttrs) {
      $stuff->specialities()->sync(array_filter($specialitiesAttrs));
    }

    return $stuff;
  }

  public function update($attributes, $where)
  {
    $stuffAttrs = Arr::get($attributes, 'stuffs');
    $stuff = Stuff::where($where)->firstOrFail();
    $stuff->fill($stuffAttrs);
    $stuff->save();

    $specialitiesAttrs = Arr::get($attributes, 'specialities');
    $stuff->specialities()->sync(array_filter($specialitiesAttrs));

    return $stuff;
  }
}
