<?php
namespace App\Enums\Stuff;

use App\Enums\BaseEnum;

final class Job extends BaseEnum
{
    const DOCTOR = 5;
    const STUFF = 10;

    public static function asList(): array {
        return [
            self::DOCTOR => "医師",
            self::STUFF => "スタッフ",
        ];
    }
}
