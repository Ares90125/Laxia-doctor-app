<?php
namespace App\Enums\Stuff;

use App\Enums\BaseEnum;

final class Speciality extends BaseEnum
{
    const SPECIALITY01 = 1;
    const SPECIALITY02 = 2;
    const SPECIALITY03 = 3;
    const SPECIALITY04 = 4;
    const SPECIALITY05 = 5;
    const SPECIALITY06 = 6;
    const SPECIALITY07 = 7;
    const SPECIALITY08 = 8;
    const SPECIALITY09 = 9;
    const SPECIALITY10 = 10;
    const SPECIALITY11 = 11;
    const SPECIALITY12 = 12;
    const SPECIALITY13 = 13;
    const SPECIALITY14 = 14;
    const SPECIALITY15 = 15;
    const SPECIALITY16 = 16;
    const SPECIALITY17 = 17;
    const SPECIALITY18 = 18;
    const SPECIALITY19 = 19;
    const SPECIALITY20 = 20;
    const SPECIALITY21 = 21;

    public static function asList(): array {
        return [
            self::SPECIALITY01 => "二重・目元整形",
            self::SPECIALITY02 => "小顔整形・フェイスライン",
            self::SPECIALITY03 => "若返り・エイジングケア",
            self::SPECIALITY04 => "鼻整形",
            self::SPECIALITY05 => "美容皮膚科",
            self::SPECIALITY06 => "レーザー脱毛",
            self::SPECIALITY07 => "シワ取り",
            self::SPECIALITY08 => "医療レーザー外来",
            self::SPECIALITY09 => "脂肪吸引",
            self::SPECIALITY10 => "豊胸施術",
            self::SPECIALITY11 => "ワキガ・多汗症治療",
            self::SPECIALITY12 => "婦人科形成",
            self::SPECIALITY13 => "タトゥー除去",
            self::SPECIALITY14 => "アートメイク",
            self::SPECIALITY15 => "AGA",
            self::SPECIALITY16 => "FAGA",
            self::SPECIALITY17 => "審美美化",
            self::SPECIALITY18 => "美容点滴・注射",
            self::SPECIALITY19 => "不妊治療",
            self::SPECIALITY20 => "レーシック",
            self::SPECIALITY21 => "下肢静脈瘤",
        ];
    }
}
