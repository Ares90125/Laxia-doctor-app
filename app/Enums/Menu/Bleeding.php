<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Bleeding extends BaseEnum
{
    const BLEEDING01 = 5;
    const BLEEDING02 = 10;
    const BLEEDING03 = 15;

    public static function asList(): array {
        return [
            self::BLEEDING01 => "あり",
            self::BLEEDING02 => "個人差あり",
            self::BLEEDING03 => "なし",
        ];
    }
}
