<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class HospitalNeed extends BaseEnum
{
    const HOSPITALNeed01 = 5;
    const HOSPITALNeed02 = 10;

    public static function asList(): array {
        return [
            self::HOSPITALNeed01 => "あり",
            self::HOSPITALNeed02 => "なし",
        ];
    }
}
