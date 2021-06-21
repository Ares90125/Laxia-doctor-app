<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Hare extends BaseEnum
{
    const HARE01 = 5;
    const HARE02 = 10;
    const HARE03 = 15;
    const HARE04 = 20;
    const HARE05 = 25;
    const HARE06 = 30;

    public static function asList(): array {
        return [
            self::HARE01 => "3日ほど",
            self::HARE02 => "3~7日ほど",
            self::HARE03 => "1~2週間ほど",
            self::HARE04 => "1ヶ月ほど",
            self::HARE05 => "なし",
            self::HARE05 => "ほとんどなし",
        ];
    }
}
