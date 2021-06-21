<?php
namespace App\Enums\Menu;

use App\Enums\BaseEnum;

final class SportImpossible extends BaseEnum
{
    const SPORTIMPOSSIBLE01 = 5;
    const SPORTIMPOSSIBLE02 = 10;
    const SPORTIMPOSSIBLE03 = 15;
    const SPORTIMPOSSIBLE04 = 20;

    public static function asList(): array {
        return [
            self::SPORTIMPOSSIBLE01 => "3日控えてください",
            self::SPORTIMPOSSIBLE02 => "1週間控えてください",
            self::SPORTIMPOSSIBLE03 => "2週間控えてください",
            self::SPORTIMPOSSIBLE04 => "1ヶ月控えてください",
        ];
    }
}
