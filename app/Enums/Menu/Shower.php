<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Shower extends BaseEnum
{
    const SHOWER01 = 5;
    const SHOWER02 = 10;
    const SHOWER03 = 15;
    const SHOWER04 = 20;
    const SHOWER05 = 25;

    public static function asList(): array {
        return [
            self::SHOWER01 => "当日から大丈夫です。",
            self::SHOWER02 => "明日から大丈夫です。",
            self::SHOWER03 => "2,3日後から大丈夫です。",
            self::SHOWER04 => "5日後から大丈夫です。",
            self::SHOWER05 => "1週間後から大丈夫です。",
        ];
    }
}
