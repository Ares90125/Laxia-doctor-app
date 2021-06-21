<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Master\Category;
use App\Models\Menu;
use DB;
use Auth;
use Throwable;

/**
 * Class MenuService
 * @package App\Services
 */
class MenuService
{
  public function paginate($search)
  {
    $per_page = isset($search['per_page']) ? $search['per_page'] : 20;
    $query = Menu::query()
      ->with([
        'category',
        'clinic'
      ]);

    if (isset($search['clinic_id'])) {
      $query->where('clinic_id', $search['clinic_id']);
    }

    if (isset($search['status'])) {
      $query->where('status', $search['status']);
    } else {
      $query->where('status', '1');
    }

    if (isset($search['category_id'])) {
      if (is_array($search['category_id'])) {
        if (!empty(array_filter($search['category_id']))) {
          $query->whereIn('category_id', $search['category_id']);
        }
      } else if ($search['category_id'] != '-1') {
        $category = Category::find($search['category_id']);
        $ids = $category->descendantsAndSelf()->pluck('id');
        $query->whereIn('category_id', $ids);
      }
    }

    if (isset($search['favorite']) && $search['favorite'] == 1)
    {
      $currentUser = auth()->guard('patient')->user();
      if (isset($currentUser) && isset($currentUser->patient)) {
        $patient_id = $currentUser->patient->id;
        $query->whereIn('id', function($subquery) use ($patient_id) {
          $subquery->select('favoriable_id')
            ->from('favorites')
            ->where('favoriable_type', 'App\Models\Menu')
            ->where('patient_id', $patient_id);
        });
      }
    }

    if (isset($search['pref_id'])) {
      $pref_id = $search['pref_id'];
      $query->whereHas('clinic', function($subquery) use ($pref_id) {
        $subquery->where('pref_id', $pref_id);
      });
    }

    if (isset($search['city'])) {
      $city = $search['city'];
      $query->whereHas('clinic', function($subquery) use ($city) {
        $subquery->where('addr01', $city);
      }); 
    }

    $query->orderby('created_at', 'desc');
    return $query->paginate($per_page);
  }

  public function toArray($params)
  {
    $query = Menu::query()
      ->public();
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
    return Menu::findOrFail($id);
  }

  public function store($attributes, $addtional = [])
  {
    $menuAttrs = Arr::get($attributes, 'menus');
    $data = array_merge($menuAttrs, $addtional);
    return Menu::create($data);
  }

  public function update($attributes, $where)
  {
    $menuAttrs = Arr::get($attributes, 'menus');
    $menu = Menu::where($where)->firstOrFail();
    $menu->update($menuAttrs);
    return $menu;
  }
}
