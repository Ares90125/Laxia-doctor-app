<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class HospitalVisit extends BaseEnum
{
    const HOSPITALVISIT01 = 5;
    const HOSPITALVISIT02 = 10;

    public static function asList(): array {
        return [
            self::HOSPITALVISIT01 => "あり",
            self::HOSPITALVISIT02 => "なし",
        ];
    }
}
