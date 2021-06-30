<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class Makeup extends BaseEnum
{
    const MAKEUP01 = 5;
    const MAKEUP02 = 10;
    const MAKEUP03 = 15;
    const MAKEUP04 = 20;
    const MAKEUP05 = 25;

    public static function asList(): array {
        return [
            self::MAKEUP01 => "当日から大丈夫です。",
            self::MAKEUP02 => "明日から大丈夫です。",
            self::MAKEUP03 => "2,3日後から大丈夫です。",
            self::MAKEUP04 => "5日後から大丈夫です。",
            self::MAKEUP05 => "1週間後から大丈夫です。",
        ];
    }
}
