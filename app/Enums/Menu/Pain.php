<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Pain extends BaseEnum
{
    const PAIN01 = 5;
    const PAIN02 = 10;
    const PAIN03 = 15;
    const PAIN04 = 20;
    const PAIN05 = 25;
    const PAIN06 = 30;

    public static function asList(): array {
        return [
            self::PAIN01 => "3日ほど",
            self::PAIN02 => "3~7日ほど",
            self::PAIN03 => "1~2週間ほど",
            self::PAIN04 => "1ヶ月ほど",
            self::PAIN05 => "なし",
            self::PAIN05 => "ほとんどなし",
        ];
    }
}
