<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Basshi extends BaseEnum
{
    const BASShi01 = 5;
    const BASShi02 = 10;

    public static function asList(): array {
        return [
            self::BASShi01 => "あり",
            self::BASShi02 => "なし",
        ];
    }
}
