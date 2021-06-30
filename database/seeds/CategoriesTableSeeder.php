<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('mtb_interest_categories')->truncate();
        
        DB::table('mtb_interest_categories')->insert([
            [
                'name' => '二重',
                'parent_id' => null
            ], [
                'name' => '目頭',
                'parent_id' => null
            ], [
                'name' => 'タレ目',
                'parent_id' => null
            ], [
                'name' => '小顔',
                'parent_id' => null
            ], [
                'name' => '鼻先',
                'parent_id' => null
            ], [
                'name' => '鼻を高く',
                'parent_id' => null
            ], [
                'name' => '小鼻',
                'parent_id' => null
            ], [
                'name' => '唇',
                'parent_id' => null
            ], [
                'name' => 'vライン',
                'parent_id' => null
            ], [
                'name' => 'Eライン',
                'parent_id' => null
            ], [
                'name' => '美肌',
                'parent_id' => null
            ], [
                'name' => 'ボディ',
                'parent_id' => null
            ], [
                'name' => '目元',
                'parent_id' => null
            ], [
                'name' => '鼻',
                'parent_id' => null
            ], [
                'name' => '輪郭',
                'parent_id' => null
            ], [
                'name' => '胸',
                'parent_id' => null
            ], [
                'name' => '口元',
                'parent_id' => null
            ], [
                'name' => '審美歯科',
                'parent_id' => null
            ], [
                'name' => 'アンチエイジング',
                'parent_id' => null
            ], [
                'name' => '二重切開',
                'parent_id' => 1
            ], [
                'name' => '二重埋没',
                'parent_id' => 1
            ], [
                'name' => '目頭切開',
                'parent_id' => 2
            ], [
                'name' => '目尻切開',
                'parent_id' => 3
            ], [
                'name' => 'グラマラスライン',
                'parent_id' => 3
            ], [
                'name' => 'タレ目ボトックス',
                'parent_id' => 3
            ], [
                'name' => '頬骨削り',
                'parent_id' => 4
            ], [
                'name' => '脂肪溶解注射(顔)',
                'parent_id' => 4
            ], [
                'name' => '脂肪吸引(顔)',
                'parent_id' => 4
            ], [
                'name' => '糸リフトアップ',
                'parent_id' => 4
            ], [
                'name' => 'バッカルファット除去',
                'parent_id' => 4
            ], [
                'name' => 'メーラーファット除去',
                'parent_id' => 4
            ], [
                'name' => 'リフトアップレーザー',
                'parent_id' => 4
            ], [
                'name' => '切開リフトアップ',
                'parent_id' => 4
            ], [
                'name' => '鼻尖形成',
                'parent_id' => 5
            ], [
                'name' => '鼻中隔延長',
                'parent_id' => 5
            ], [
                'name' => '軟骨移植',
                'parent_id' => 5
            ], [
                'name' => 'ハイコ・ミスコ',
                'parent_id' => 5
            ], [
                'name' => '隆鼻術',
                'parent_id' => 6
            ], [
                'name' => '鼻ヒアルロン酸注射',
                'parent_id' => 6
            ], [
                'name' => 'レディエッセ注入',
                'parent_id' => 6
            ], [
                'name' => '眉間プロテーゼ',
                'parent_id' => 6
            ], [
                'name' => '小鼻縮小',
                'parent_id' => 7
            ], [
                'name' => '鼻翼挙上手術',
                'parent_id' => 7
            ], [
                'name' => '唇ヒアルロン酸注入',
                'parent_id' => 8
            ], [
                'name' => '口角ボトックス',
                'parent_id' => 8
            ], [
                'name' => 'あご骨切り',
                'parent_id' => 9
            ], [
                'name' => 'エラ骨削り',
                'parent_id' => 9
            ], [
                'name' => '頬骨削り',
                'parent_id' => 9
            ], [
                'name' => '脂肪吸引(顔)',
                'parent_id' => 9
            ], [
                'name' => 'バッカルファット除去',
                'parent_id' => 9
            ], [
                'name' => 'あごプロテーゼ',
                'parent_id' => 9
            ], [
                'name' => 'あごヒアルロン酸',
                'parent_id' => 10
            ], [
                'name' => 'あご骨切り',
                'parent_id' => 10
            ], [
                'name' => 'セットバック',
                'parent_id' => 10
            ], [
                'name' => 'あごプロテーゼ',
                'parent_id' => 10
            ], [
                'name' => 'ルフォー+ssro(両あご)',
                'parent_id' => 10
            ], [
                'name' => 'あごボトックス',
                'parent_id' => 11
            ], [
                'name' => '肌ヒアルロン酸注入',
                'parent_id' => 11
            ], [
                'name' => '水光注射',
                'parent_id' => 11
            ], [
                'name' => 'ほくろ除去',
                'parent_id' => 11
            ], [
                'name' => 'ニキビ治療',
                'parent_id' => 11
            ], [
                'name' => '美肌レーザー',
                'parent_id' => 11
            ], [
                'name' => 'ピーリング',
                'parent_id' => 11
            ], [
                'name' => 'イオン導入',
                'parent_id' => 11
            ], [
                'name' => '脂肪注入',
                'parent_id' => 11
            ], [
                'name' => '美肌注射・点滴',
                'parent_id' => 11
            ], [
                'name' => 'ダーマローラー・ダーマペン',
                'parent_id' => 11
            ], [
                'name' => 'ヒアルロン酸溶解',
                'parent_id' => 11
            ], [
                'name' => '再生治療',
                'parent_id' => 11
            ], [
                'name' => 'co2レーザー',
                'parent_id' => 11
            ], [
                'name' => 'しみとりレーザー',
                'parent_id' => 11
            ], [
                'name' => 'フォトRF',
                'parent_id' => 11
            ], [
                'name' => '白玉点滴',
                'parent_id' => 11
            ], [
                'name' => '美肌レーザー',
                'parent_id' => 11
            ], [
                'name' => 'プラセンタ注射',
                'parent_id' => 11
            ], [
                'name' => 'アートメイク/まゆ',
                'parent_id' => 11
            ], [
                'name' => 'アートメイク/唇',
                'parent_id' => 11
            ], [
                'name' => 'アートメイク/アイライン',
                'parent_id' => 11
            ], [
                'name' => 'アートメイク/ヘアライン',
                'parent_id' => 11
            ], [
                'name' => 'シワ取りボトックス',
                'parent_id' => 11
            ], [
                'name' => 'PRP皮膚再生治療',
                'parent_id' => 11
            ], [
                'name' => 'エレクトロポレーション',
                'parent_id' => 11
            ], [
                'name' => 'ハイドラフェイシャル',
                'parent_id' => 11
            ], [
                'name' => 'ピコレーザー',
                'parent_id' => 11
            ], [
                'name' => 'フォトシルクプラス',
                'parent_id' => 11
            ], [
                'name' => 'フォトフェイシャル',
                'parent_id' => 11
            ], [
                'name' => 'フラクショナルレーザー',
                'parent_id' => 11
            ], [
                'name' => 'YAGレーザー',
                'parent_id' => 11
            ], [
                'name' => 'ルビーレーザー',
                'parent_id' => 11
            ], [
                'name' => '傷跡修正',
                'parent_id' => 11
            ], [
                'name' => 'タトゥー除去',
                'parent_id' => 11
            ], [
                'name' => 'サーマクール',
                'parent_id' => 11
            ], [
                'name' => 'こめかみヒアルロン酸',
                'parent_id' => 11
            ], [
                'name' => 'GLP-1ダイエット',
                'parent_id' => 12
            ], [
                'name' => 'エムスカルプト',
                'parent_id' => 12
            ], [
                'name' => 'インディバ',
                'parent_id' => 12
            ], [
                'name' => '脂肪吸引(二の腕)',
                'parent_id' => 12
            ], [
                'name' => '脂肪吸引(太もも)',
                'parent_id' => 12
            ], [
                'name' => '脂肪吸引(お腹)',
                'parent_id' => 12
            ], [
                'name' => '脂肪吸引(ヒップ)',
                'parent_id' => 12
            ], [
                'name' => 'ふくらはぎボトックス',
                'parent_id' => 12
            ], [
                'name' => '脂肪溶解注射',
                'parent_id' => 12
            ], [
                'name' => '志望溶解注射(二の腕)',
                'parent_id' => 12
            ], [
                'name' => '脂肪溶解注射(太もも)',
                'parent_id' => 12
            ], [
                'name' => '志望溶解注射(お腹)',
                'parent_id' => 12
            ], [
                'name' => '志望溶解注射(ヒップ)',
                'parent_id' => 12
            ], [
                'name' => '肩ボトックス',
                'parent_id' => 12
            ], [
                'name' => 'その他',
                'parent_id' => 12
            ], [
                'name' => '二重埋没',
                'parent_id' => 13
            ], [
                'name' => '二重切開',
                'parent_id' => 13
            ], [
                'name' => '目頭切開',
                'parent_id' => 13
            ], [
                'name' => '目尻切開',
                'parent_id' => 13
            ], [
                'name' => '眼瞼下垂',
                'parent_id' => 13
            ], [
                'name' => 'くま治療',
                'parent_id' => 13
            ], [
                'name' => '涙袋形成',
                'parent_id' => 13
            ], [
                'name' => '上まぶたたるみ取り',
                'parent_id' => 13
            ], [
                'name' => '下まぶたたるみ取り',
                'parent_id' => 13
            ], [
                'name' => '上まぶたの脂肪取り',
                'parent_id' => 13
            ], [
                'name' => '下まぶたの脂肪取り',
                'parent_id' => 13
            ], [
                'name' => 'まぶたの脂肪溶解注射',
                'parent_id' => 13
            ], [
                'name' => '豪古ひだ形成',
                'parent_id' => 13
            ], [
                'name' => 'グラマラスライン',
                'parent_id' => 13
            ], [
                'name' => '眉下切開',
                'parent_id' => 13
            ], [
                'name' => '前額リフト',
                'parent_id' => 13
            ], [
                'name' => 'タレ目ボトックス',
                'parent_id' => 13
            ], [
                'name' => '目尻靭帯移動',
                'parent_id' => 13
            ], [
                'name' => '目元修正',
                'parent_id' => 13
            ], [
                'name' => '自然癒着法',
                'parent_id' => 13
            ], [
                'name' => '目の下ヒアルロン酸注入',
                'parent_id' => 13
            ], [
                'name' => 'その他',
                'parent_id' => 13
            ], [
                'name' => '隆鼻術',
                'parent_id' => 14
            ], [
                'name' => '鼻尖形成',
                'parent_id' => 14
            ], [
                'name' => '鼻中隔延長',
                'parent_id' => 14
            ], [
                'name' => '小鼻縮小',
                'parent_id' => 14
            ], [
                'name' => '鼻ヒアルロン酸注入',
                'parent_id' => 14
            ], [
                'name' => 'レディエッセ注入',
                'parent_id' => 14
            ], [
                'name' => '軟骨移植',
                'parent_id' => 14
            ], [
                'name' => '骨切幅寄せ',
                'parent_id' => 14
            ], [
                'name' => 'ハイフ切除',
                'parent_id' => 14
            ], [
                'name' => '斜鼻修正',
                'parent_id' => 14
            ], [
                'name' => '鼻翼挙上手術',
                'parent_id' => 14
            ], [
                'name' => '鼻翼基部プレテーゼ',
                'parent_id' => 14
            ], [
                'name' => '眉間プロテーゼ',
                'parent_id' => 14
            ], [
                'name' => 'プロテーゼ除去',
                'parent_id' => 14
            ], [
                'name' => 'ハイコ・ミスコ',
                'parent_id' => 14
            ], [
                'name' => '鼻孔緑挙上',
                'parent_id' => 14
            ], [
                'name' => '鼻尖形成',
                'parent_id' => 14
            ], [
                'name' => '真皮移植',
                'parent_id' => 14
            ], [
                'name' => '鼻孔緑挙下',
                'parent_id' => 14
            ], [
                'name' => '鼻修正',
                'parent_id' => 14
            ], [
                'name' => 'その他',
                'parent_id' => 14
            ], [
                'name' => 'あごヒアルロン酸',
                'parent_id' => 15
            ], [
                'name' => 'あご骨切り',
                'parent_id' => 15
            ], [
                'name' => 'エラ・小顔ボトックス',
                'parent_id' => 15
            ], [
                'name' => 'エラ骨削り',
                'parent_id' => 15
            ], [
                'name' => '頬骨削り',
                'parent_id' => 15
            ], [
                'name' => '脂肪溶解注射(顔)',
                'parent_id' => 15
            ], [
                'name' => '糸リフトアップ',
                'parent_id' => 15
            ], [
                'name' => '脂肪吸引(顔)',
                'parent_id' => 15
            ], [
                'name' => 'バッカルプァット除去',
                'parent_id' => 15
            ], [
                'name' => 'メーラーファット除去',
                'parent_id' => 15
            ], [
                'name' => 'あごプロテーゼ',
                'parent_id' => 15
            ], [
                'name' => 'あごレディエッセ注入',
                'parent_id' => 15
            ], [
                'name' => 'リフトアップレーザー',
                'parent_id' => 15
            ], [
                'name' => '脂肪注入',
                'parent_id' => 15
            ], [
                'name' => '額を丸く',
                'parent_id' => 15
            ], [
                'name' => '豊胸(ヒアルロン酸)',
                'parent_id' => 16
            ], [
                'name' => '豊胸(シリコンパック)',
                'parent_id' => 16
            ], [
                'name' => '豊胸(脂肪注入)',
                'parent_id' => 16
            ], [
                'name' => '胸修正',
                'parent_id' => 16
            ], [
                'name' => 'その他',
                'parent_id' => 16
            ], [
                'name' => '唇ヒアルロン酸',
                'parent_id' => 17
            ], [
                'name' => '口角ボトックス',
                'parent_id' => 17
            ], [
                'name' => '人中短縮術',
                'parent_id' => 17
            ], [
                'name' => '唇縮小術',
                'parent_id' => 17
            ], [
                'name' => 'ガミースマイル手術',
                'parent_id' => 17
            ], [
                'name' => 'セットパック',
                'parent_id' => 17
            ], [
                'name' => '口角挙上',
                'parent_id' => 17
            ], [
                'name' => 'その他',
                'parent_id' => 17
            ], [
                'name' => '矯正',
                'parent_id' => 18
            ], [
                'name' => 'セラミック',
                'parent_id' => 18
            ], [
                'name' => 'ホワイトニング',
                'parent_id' => 18
            ], [
                'name' => 'その他',
                'parent_id' => 18
            ], [
                'name' => 'あごボトックス',
                'parent_id' => 19
            ], [
                'name' => '肌ヒアルロン酸注入',
                'parent_id' => 19
            ], [
                'name' => '水光注射',
                'parent_id' => 19
            ], [
                'name' => 'くま治療',
                'parent_id' => 19
            ], [
                'name' => '糸リフトアップ',
                'parent_id' => 19
            ], [
                'name' => '美肌レーザー',
                'parent_id' => 19
            ], [
                'name' => '下まぶたたるみ取り',
                'parent_id' => 19
            ], [
                'name' => 'ピーリング',
                'parent_id' => 19
            ], [
                'name' => 'イオン導入',
                'parent_id' => 19
            ], [
                'name' => '下まぶた脂肪取り',
                'parent_id' => 19
            ], [
                'name' => '美肌注射点滴',
                'parent_id' => 19
            ], [
                'name' => 'ダーマローラー・ダーマペン',
                'parent_id' => 19
            ], [
                'name' => '切開リフトアップ',
                'parent_id' => 19
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
