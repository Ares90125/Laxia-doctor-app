<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Massage extends BaseEnum
{
    const MASSAGE01 = 5;
    const MASSAGE02 = 10;
    const MASSAGE03 = 15;
    const MASSAGE04 = 20;

    public static function asList(): array {
        return [
            self::MASSAGE01 => "3日控えてください",
            self::MASSAGE02 => "1週間控えてください",
            self::MASSAGE03 => "2週間控えてください",
            self::MASSAGE04 => "1ヶ月控えてください",
        ];
    }
}
