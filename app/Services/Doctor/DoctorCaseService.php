<?php
namespace App\Services\Doctor;

use Illuminate\Support\Arr;
use App\Models\DoctorCases;
use App\Models\DoctorCaseImages;
use App\Models\DoctorCaseMenus;
use App\Models\DoctorCaseCategoryRelation;
use App\Enums\Doctor\PhotoType;
use App\Models\Menu;
use DB;
use Auth;
use Throwable;

/**
 * Class CommentService
 * @package App\Services
 */
class DoctorCaseService
{
  // public function paginate($params, $commentable)
  // {
  //   $per_page = $params['per_page'] ?? 50;

  //   return $commentable->comments()
  //     ->with('allChildren')
  //     ->whereNull('parent_id')
  //     ->orderBy('created_at', 'DESC')
  //     ->paginate($per_page);
  // }

  public function paginate($search) {
      $per_page = isset($search['per_page']) ? $search['per_page'] : 20;
      $query = DoctorCases::query()
        ->with([]);

      if (isset($search['doctor_id'])) {
        $query->where('doctor_id', $search['doctor_id']);
      }

      if (isset($search['category_id']) && $search['category_id'] != '') {
        $cat_ids = explode('_', $search['category_id']);

        $query->join('doctor_case_category_relation as dccr', 'doctor_cases.id', '=', 'dccr.case_id')
              // ->where('dccr.category_id', $search['category_id']);
              ->whereIn('dccr.category_id', $cat_ids);
      }
      
      $query->orderby('created_at', 'desc');
      $query->select('doctor_cases.*');

      return $query->paginate($per_page);
  }

  public function store($attributes, $doctor_id)
  {
    $doctorCase = DoctorCases::create([
      'doctor_id' => $doctor_id,
      'title' => $attributes['title'],
      'age' => $attributes['age'],
      'gender' => $attributes['gender'],
      'operation' => $attributes['operation'],
      'operationRisk' => $attributes['operationRisk'],
      'majordoctorComment' => $attributes['majordoctorComment'],
    ]);

    if (isset($attributes['before_photo'])) {
      for ($i = 0; $i < count($attributes['before_photo']); $i++) {
        DoctorCaseImages::create([
          'case_id' => $doctorCase->id,
          'type' => PhotoType::BEFORE,
          'photo' => $attributes['before_photo'][$i]
        ]);
      }
    }

    if (isset($attributes['after_photo'])) {
      for ($i = 0; $i < count($attributes['after_photo']); $i++) {
        DoctorCaseImages::create([
          'case_id' => $doctorCase->id,
          'type' => PhotoType::AFTER,
          'photo' => $attributes['after_photo'][$i]
        ]);
      }
    }

    if (isset($attributes['menuProperty'])) {
      for ($i = 0; $i < count($attributes['menuProperty']); $i++) {

        if(empty($attributes['menuProperty'][$i]['name'])) continue;
        
        if(empty($attributes['menuProperty'][$i]['id'])) {
          $menu_id = \DB::table('menus')->insertGetId([
              'name' => $attributes['menuProperty'][$i]['name'],
              'price' => $attributes['menuProperty'][$i]['price']
          ]);
  
          DoctorCaseMenus::create([
              'case_id' => $doctorCase->id,
              'menu_id' => $menu_id
          ]);
        } else {
          DoctorCaseMenus::create([
            'case_id' => $doctorCase->id,
            'menu_id' => $attributes['menuProperty'][$i]['id']
          ]);
        }
      }
    }

    // if (isset($attributes['existedMenuProperty'])) {
    //   for ($i = 0; $i < count($attributes['existedMenuProperty']); $i++) {

    //     if(empty($attributes['existedMenuProperty'][$i]['id'])) continue;

    //     DoctorCaseMenus::create([
    //       'case_id' => $doctorCase->id,
    //       'menu_id' => $attributes['existedMenuProperty'][$i]['id']
    //     ]);
    //   }
    // }

    if (isset($attributes['category'])) {
      for ($i = 0; $i < count($attributes['category']); $i++) {
        DoctorCaseCategoryRelation::create([
          'case_id' => $doctorCase->id,
          'category_id' => $attributes['category'][$i]['id']
        ]);
      }
    }

    return $doctorCase;
  }

  public function delete($doctor_id, $id)
  {
    $case = DoctorCases::where('id', $id)
      ->where('doctor_id', $doctor_id)
      ->first();

    if (!isset($case)) {
      return false;
    }
    DoctorCaseImages::where('case_id', $id)->delete();
    DoctorCaseMenus::where('case_id', $id)->delete();
    DoctorCaseCategoryRelation::where('case_id', $id)->delete();

    $case->delete();
    return true;
  }

  public function get($id)
  {
    return DoctorCases::where('doctor_id', $id)
      ->get();
  }

  public function getDetail($id)
  {
    return DoctorCases::where('id', $id)
      ->firstOrFail();
  }

  public function update($attributes, $doctor_id, $id)
  {
    $case = DoctorCases::where('doctor_id', $doctor_id)
      ->where('id', $id)
      ->firstOrFail();
    $case->fill($attributes);
    $case->save();

    if (isset($attributes['before_photo'])) {
      $beforePhoto = $attributes['before_photo'];
      if (isset($beforePhoto['add'])) {
        for ($i = 0; $i < count($beforePhoto['add']); $i++) {
          DoctorCaseImages::create([
            'case_id' => $id,
            'type' => PhotoType::BEFORE,
            'photo' => $beforePhoto['add'][$i]
          ]);
        }
      }

      if (isset($beforePhoto['delete'])) {
        for ($i = 0; $i < count($beforePhoto['delete']); $i++) {
          DoctorCaseImages::where('id', $beforePhoto['delete'][$i])
            ->where('type', PhotoType::BEFORE)
            ->where('case_id', $id)
            ->delete();
        }
      }
    }

    if (isset($attributes['after_photo'])) {
      $afterPhoto = $attributes['after_photo'];
      if (isset($afterPhoto['add'])) {
        for ($i = 0; $i < count($afterPhoto['add']); $i++) {
          DoctorCaseImages::create([
            'case_id' => $id,
            'type' => PhotoType::AFTER,
            'photo' => $afterPhoto['add'][$i]
          ]);
        }
      }

      if (isset($afterPhoto['delete'])) {
        for ($i = 0; $i < count($afterPhoto['delete']); $i++) {
          DoctorCaseImages::where('id', $afterPhoto['delete'][$i])
            ->where('type', PhotoType::AFTER)
            ->where('case_id', $id)
            ->delete();
        }
      }
    }

    if (isset($attributes['category'])) {
      $category = $attributes['category'];
      if (isset($category['add'])) {
        for ($i = 0; $i < count($category['add']); $i++) {
          DoctorCaseCategoryRelation::create([
            'case_id' => $id,
            'category_id' => $category['add'][$i]['id']
          ]);
        }
      }

      if (isset($category['delete'])) {
        for ($i = 0; $i < count($category['delete']); $i++) {
          DoctorCaseCategoryRelation::where('category_id', $category['delete'][$i])
            ->where('case_id', $id)
            ->delete();
        }
      }
    }

    if (isset($attributes['menuProperty'])) {
      $menuProperty = $attributes['menuProperty'];
      if (isset($menuProperty['add'])) {
        for ($i = 0; $i < count($menuProperty['add']); $i++) {

          if(empty($menuProperty['add'][$i]['id'])) {
            $menu_id = \DB::table('menus')->insertGetId([
              'name' => $menuProperty['add'][$i]['name'],
              'price' => $menuProperty['add'][$i]['price']
            ]);
  
            DoctorCaseMenus::create([
                'case_id' => $id,
                'menu_id' => $menu_id
            ]);
          } else {
            DoctorCaseMenus::create([
              'case_id' => $id,
              'menu_id' => $menuProperty['add'][$i]['id']
            ]);
          }          
        }
      }

      if (isset($menuProperty['update'])) {
        for ($i = 0; $i < count($menuProperty['update']); $i++) {
          $menu = Menu::where('id', $menuProperty['update'][$i]['id'])
            ->first();
          $menu->fill($menuProperty['update'][$i]);
          $menu->save();
        }
      }

      if (isset($menuProperty['delete'])) {
        for ($i = 0; $i < count($menuProperty['delete']); $i++) {
          DoctorCaseMenus::where('menu_id', $menuProperty['delete'][$i]['id'])
            ->where('case_id', $id)
            ->delete();
        }
      }
    }

    return $case;
  }
}
