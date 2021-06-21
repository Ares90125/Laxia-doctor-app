<?php
namespace App\Enums\Common;

use App\Enums\BaseEnum;

final class Gender extends BaseEnum
{
    const MALE = "male";
    const FEMALE = "female";

    public static function asList(): array {
        return [
            self::MALE => "男性",
            self::FEMALE => "女性",
        ];
    }
}
