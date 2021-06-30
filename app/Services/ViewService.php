<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Patient;
use DB;
use Auth;
use Throwable;

/**
 * Class ViewService
 * @package App\Services
 */
class ViewService
{
  public function view(Patient $patient, $viewable)
  {
    $exist = $viewable->viewers()->where('patient_id', $patient->id)->exists();
    if (!$exist) {
      $viewable->viewers()->attach($patient);
      return true;
    }
    return false;
  }
}
