<?php
namespace App\Enums\Reservation;

use App\Enums\BaseEnum;

final class Content extends BaseEnum
{
    const COUNSELING = 5;
    const TREATMENT = 10;
    const TEST = 15;
    const TREATMENTCOUNSELING = 20;

    public static function asList(): array {
        return [
            self::COUNSELING => "カウンセリング",
            self::TREATMENT => "施術",
            self::TEST => "術後検査",
            self::TREATMENTCOUNSELING => "施術・カウンセリング",
        ];
    }
}
