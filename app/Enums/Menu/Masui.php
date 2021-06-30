<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Masui extends BaseEnum
{
    const MASUI01 = 5;
    const MASUI02 = 10;
    const MASUI03 = 15;

    public static function asList(): array {
        return [
            self::MASUI01 => "局所麻酔",
            self::MASUI02 => "全身麻酔",
            self::MASUI03 => "なし",
        ];
    }
}
