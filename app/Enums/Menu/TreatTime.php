<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class TreatTime extends BaseEnum
{
    const TREATTIME01 = 5;
    const TREATTIME02 = 10;
    const TREATTIME03 = 15;
    const TREATTIME04 = 20;
    const TREATTIME05 = 25;

    public static function asList(): array {
        return [
            self::TREATTIME01 => "10分以内",
            self::TREATTIME02 => "10分~30分",
            self::TREATTIME03 => "30分~1時間",
            self::TREATTIME04 => "2時間",
            self::TREATTIME05 => "3時間以上",
        ];
    }
}
