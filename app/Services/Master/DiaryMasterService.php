<?php
namespace App\Services\Master;

use Illuminate\Support\Arr;
use App\Models\Master\DiaryTextQuestion;
use App\Models\Master\DiaryRateQuestion;
use DB;
use Auth;
use Throwable;

/**
 * Class DiaryMasterService
 * @package App\Services
 */
class DiaryMasterService
{
  public function loadMaster()
  {
    $textQuestions = DiaryTextQuestion::all();
    $rateQuestions = DiaryRateQuestion::all();

    return [
      'textQuestions' => $textQuestions,
      'rateQuestions' => $rateQuestions,
    ];
  }
}
