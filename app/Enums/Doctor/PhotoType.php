<?php
namespace App\Enums\Doctor;

use App\Enums\BaseEnum;

final class PhotoType extends BaseEnum
{
    const BEFORE = "before";
    const AFTER = "after";

    public static function asList(): array {
        return [
            self::BEFORE => "before",
            self::AFTER => "after",
        ];
    }
}
