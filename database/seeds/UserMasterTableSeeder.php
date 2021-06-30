<?php

use Illuminate\Database\Seeder;

class UserMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        DB::table('mtb_part_categories')->truncate();
        DB::table('mtb_part_categories')->insert([
            [
                'name' => '目元',
                'parent_id' => null
            ], [
                'name' => '鼻',
                'parent_id' => null
            ], [
                'name' => '肌',
                'parent_id' => null
            ], [
                'name' => '顔・輪郭',
                'parent_id' => null
            ], [
                'name' => 'ボディ',
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
                'name' => 'その他',
                'parent_id' => null
            ], [
                'name' => '二重埋没',
                'parent_id' => 1
            ], [
                'name' => '目頭切開',
                'parent_id' => 1
            ], [
                'name' => '目尻切開',
                'parent_id' => 1
            ], [
                'name' => '二重切開',
                'parent_id' => 1
            ], [
                'name' => '眉下切開',
                'parent_id' => 1
            ], [
                'name' => '眼瞼下垂',
                'parent_id' => 1
            ], [
                'name' => '涙袋形成',
                'parent_id' => 1
            ], [
                'name' => '蒙古ひだ形成',
                'parent_id' => 1
            ], [
                'name' => '蒙古ひだ形成',
                'parent_id' => 1
            ], [
                'name' => '下まぶたたるみ取り',
                'parent_id' => 1
            ], [
                'name' => 'くま治療',
                'parent_id' => 1
            ], [
                'name' => '上まぶたの脂肪取り',
                'parent_id' => 1
            ], [
                'name' => '下まぶたの脂肪取り',
                'parent_id' => 1
            ], [
                'name' => 'まぶたの脂肪溶解注射',
                'parent_id' => 1
            ], [
                'name' => 'グラマラスライン',
                'parent_id' => 1
            ], [
                'name' => 'タレ目ボトックス',
                'parent_id' => 1
            ], [
                'name' => '目尻靭帯移動',
                'parent_id' => 1
            ], [
                'name' => '自然癒着法',
                'parent_id' => 1
            ], [
                'name' => '目の下ヒアルロン酸注入',
                'parent_id' => 1
            ], [
                'name' => '目元修正',
                'parent_id' => 1
            ], [
                'name' => 'その他',
                'parent_id' => 1
            ], [
                'name' => '隆鼻術',
                'parent_id' => 2
            ], [
                'name' => '鼻尖形成',
                'parent_id' => 2
            ], [
                'name' => '鼻中隔延長',
                'parent_id' => 2
            ], [
                'name' => '小鼻縮小',
                'parent_id' => 2
            ], [
                'name' => '鼻ヒアルロン酸注入',
                'parent_id' => 2
            ], [
                'name' => 'レディエッセ注入',
                'parent_id' => 2
            ], [
                'name' => '軟骨移植',
                'parent_id' => 2
            ], [
                'name' => '骨切幅寄せ',
                'parent_id' => 2
            ], [
                'name' => 'ハンプ切除',
                'parent_id' => 2
            ], [
                'name' => '斜鼻修正',
                'parent_id' => 2
            ], [
                'name' => '鼻翼挙上手術',
                'parent_id' => 2
            ], [
                'name' => 'プロテーゼ除去',
                'parent_id' => 2
            ], [
                'name' => 'ハイコ・ミスコ',
                'parent_id' => 2
            ], [
                'name' => '鼻孔縁挙上',
                'parent_id' => 2
            ], [
                'name' => '鼻翼基部プロテーゼ（貴族手術）',
                'parent_id' => 2
            ], [
                'name' => '眉間プロテーゼ',
                'parent_id' => 2
            ], [
                'name' => '鼻尖縮小',
                'parent_id' => 2
            ], [
                'name' => '真皮移植',
                'parent_id' => 2
            ], [
                'name' => '鼻孔縁下降',
                'parent_id' => 2
            ], [
                'name' => '鼻修正',
                'parent_id' => 2
            ], [
                'name' => 'その他',
                'parent_id' => 2
            ], [
                'name' => 'ほくろ除去',
                'parent_id' => 3
            ], [
                'name' => 'ニキビ治療',
                'parent_id' => 3
            ], [
                'name' => 'ピーリング',
                'parent_id' => 3
            ], [
                'name' => 'イオン導入',
                'parent_id' => 3
            ], [
                'name' => '脂肪注入',
                'parent_id' => 3
            ], [
                'name' => '肌ヒアルロン酸注入',
                'parent_id' => 3
            ], [
                'name' => 'ヒアルロン酸溶解',
                'parent_id' => 3
            ], [
                'name' => 'こめかみヒアルロン酸注入',
                'parent_id' => 3
            ], [
                'name' => '水光注射',
                'parent_id' => 3
            ], [
                'name' => '白玉点滴',
                'parent_id' => 3
            ], [
                'name' => '美肌注射・点滴',
                'parent_id' => 3
            ], [
                'name' => 'プラセンタ注射',
                'parent_id' => 3
            ], [
                'name' => 'ダーマローラー・ダーマペン',
                'parent_id' => 3
            ], [
                'name' => 'CO2レーザー',
                'parent_id' => 3
            ], [
                'name' => 'シミ取りレーザー',
                'parent_id' => 3
            ], [
                'name' => '美肌レーザー',
                'parent_id' => 3
            ], [
                'name' => '美白レーザー',
                'parent_id' => 3
            ], [
                'name' => 'ピコレーザー',
                'parent_id' => 3
            ], [
                'name' => 'YAGレーザー',
                'parent_id' => 3
            ], [
                'name' => 'フラクショナルレーザー',
                'parent_id' => 3
            ], [
                'name' => 'ルビーレーザー',
                'parent_id' => 3
            ], [
                'name' => '再生治療',
                'parent_id' => 3
            ], [
                'name' => 'フォトRF',
                'parent_id' => 3
            ], [
                'name' => 'しわ取りボトックス',
                'parent_id' => 3
            ], [
                'name' => 'アートメイク',
                'parent_id' => 3
            ], [
                'name' => 'PRP皮膚再生療法',
                'parent_id' => 3
            ], [
                'name' => 'エレクトロポレーション',
                'parent_id' => 3
            ], [
                'name' => 'ハイドラフェイシャル',
                'parent_id' => 3
            ], [
                'name' => 'フォトフェイシャル',
                'parent_id' => 3
            ], [
                'name' => 'フォトシルクプラス',
                'parent_id' => 3
            ], [
                'name' => 'サーマクール',
                'parent_id' => 3
            ], [
                'name' => '傷跡修正',
                'parent_id' => 3
            ], [
                'name' => 'タトゥー除去',
                'parent_id' => 3
            ], [
                'name' => 'その他',
                'parent_id' => 3
            ], [
                'name' => 'あごヒアルロン酸注入',
                'parent_id' => 4
            ], [
                'name' => '額ヒアルロン酸注入',
                'parent_id' => 4
            ], [
                'name' => '頬ヒアルロン酸注入',
                'parent_id' => 4
            ], [
                'name' => 'あごレディエッセ注入',
                'parent_id' => 4
            ], [
                'name' => 'あごボトックス',
                'parent_id' => 4
            ], [
                'name' => 'エラ・小顔ボトックス',
                'parent_id' => 4
            ], [
                'name' => 'あごプロテーゼ',
                'parent_id' => 4
            ], [
                'name' => '額プロテーゼ',
                'parent_id' => 4
            ], [
                'name' => 'あご骨切り',
                'parent_id' => 4
            ], [
                'name' => 'エラ骨削り',
                'parent_id' => 4
            ], [
                'name' => '頬骨削り',
                'parent_id' => 4
            ], [
                'name' => '眉骨削り',
                'parent_id' => 4
            ], [
                'name' => '脂肪吸引（顔）',
                'parent_id' => 4
            ], [
                'name' => '脂肪溶解注射（顔）',
                'parent_id' => 4
            ], [
                'name' => 'バッカルファット除去',
                'parent_id' => 4
            ], [
                'name' => 'メーラーファット除去',
                'parent_id' => 4
            ], [
                'name' => '糸リフトアップ',
                'parent_id' => 4
            ], [
                'name' => '切開リフトアップ',
                'parent_id' => 4
            ], [
                'name' => 'リフトアップレーザー（ハイフ）',
                'parent_id' => 4
            ], [
                'name' => '脂肪注入',
                'parent_id' => 4
            ], [
                'name' => '額脂肪注入',
                'parent_id' => 4
            ], [
                'name' => '額を丸く',
                'parent_id' => 4
            ], [
                'name' => 'こめかみ形成',
                'parent_id' => 4
            ], [
                'name' => '輪郭修正',
                'parent_id' => 4
            ], [
                'name' => 'ルフォー+ssro（両顎)',
                'parent_id' => 4
            ], [
                'name' => '脂肪冷却',
                'parent_id' => 4
            ], [
                'name' => 'その他',
                'parent_id' => 4
            ], [
                'name' => 'GLP-1ダイエット',
                'parent_id' => 5
            ], [
                'name' => 'エムスカルプト',
                'parent_id' => 5
            ], [
                'name' => 'インディバ',
                'parent_id' => 5
            ], [
                'name' => '脂肪吸引（二の腕）',
                'parent_id' => 5
            ], [
                'name' => '脂肪吸引（太もも）',
                'parent_id' => 5
            ], [
                'name' => '脂肪吸引（お腹）',
                'parent_id' => 5
            ], [
                'name' => '脂肪吸引（ヒップ）',
                'parent_id' => 5
            ], [
                'name' => '脂肪溶解注射',
                'parent_id' => 5
            ], [
                'name' => '脂肪溶解注射(二の腕)',
                'parent_id' => 5
            ], [
                'name' => '脂肪溶解注射(太もも)',
                'parent_id' => 5
            ], [
                'name' => '脂肪溶解注射(お腹)',
                'parent_id' => 5
            ], [
                'name' => '脂肪溶解注射(ヒップ)',
                'parent_id' => 5
            ], [
                'name' => 'ヒップアップ手術',
                'parent_id' => 5
            ], [
                'name' => 'ふくらはぎボトックス',
                'parent_id' => 5
            ], [
                'name' => '肩ボトックス',
                'parent_id' => 5
            ], [
                'name' => 'その他',
                'parent_id' => 5
            ], [
                'name' => '豊胸（脂肪注入）',
                'parent_id' => 6
            ], [
                'name' => '豊胸（シリコンバッグ）',
                'parent_id' => 6
            ], [
                'name' => '豊胸（ヒアルロン酸）',
                'parent_id' => 6
            ], [
                'name' => '胸修正',
                'parent_id' => 6
            ], [
                'name' => 'その他',
                'parent_id' => 6
            ], [
                'name' => '唇ヒアルロン酸注入',
                'parent_id' => 7
            ], [
                'name' => '口角ボトックス',
                'parent_id' => 7
            ], [
                'name' => '口唇縮小術',
                'parent_id' => 7
            ], [
                'name' => '口角挙上',
                'parent_id' => 7
            ], [
                'name' => '人中短縮術',
                'parent_id' => 7
            ], [
                'name' => 'ガミースマイル手術',
                'parent_id' => 7
            ], [
                'name' => 'セットバック',
                'parent_id' => 7
            ], [
                'name' => 'その他',
                'parent_id' => 7
            ], [
                'name' => '矯正',
                'parent_id' => 8
            ], [
                'name' => 'セラミック',
                'parent_id' => 8
            ], [
                'name' => 'ホワイトニング',
                'parent_id' => 8
            ], [
                'name' => 'その他',
                'parent_id' => 8
            ], [
                'name' => '脇ボトックス',
                'parent_id' => 9
            ], [
                'name' => 'ピアス',
                'parent_id' => 9
            ], [
                'name' => '傷跡修正',
                'parent_id' => 9
            ], [
                'name' => '脱毛(顔)',
                'parent_id' => 9
            ], [
                'name' => '脱毛(ワキ)',
                'parent_id' => 9
            ], [
                'name' => '脱毛(全身)',
                'parent_id' => 9
            ], [
                'name' => '脱毛(vio)',
                'parent_id' => 9
            ], [
                'name' => '脱毛(腕)',
                'parent_id' => 9
            ], [
                'name' => '脱毛(脚)',
                'parent_id' => 9
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
