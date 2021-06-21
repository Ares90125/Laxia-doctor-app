<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\User;
use DB;
use Auth;
use Throwable;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
  public function update($attributes, $where)
  {
    $userAttrs = Arr::get($attributes, 'users');
    $user = User::where($where)
      ->firstOrFail();
    $user->fill($userAttrs);
    $user->save();

    return $user;
  }

  public function updateName($name, $id)
  {
    $user = User::where(['name' => $name])->first();
    if ($user != null && $user->id != $id) {
      return false;
    }

    $user = User::where(['id' => $id])->firstOrFail();
    $user->fill(['name' => $name]);
    $user->save();
    return true;
  }

  public function isEnableID($id)
  {
      $user = User::where(['name' => $id])->first();
      if ($user != null) {
          return false;
      }
      return true;
  }
}
