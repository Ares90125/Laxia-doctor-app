<?php
namespace App\Enums\User;

use App\Enums\BaseEnum;

final class Type extends BaseEnum
{
    const CLINIC = "clinic";
    const DOCTOR = "doctor";
    const USER = "patient";

    public static function asList(): array {
        return [
            self::CLINIC => "クリニック",
            self::DOCTOR => "ドクター",
            self::USER => "ユーザー",
        ];
    }
}
