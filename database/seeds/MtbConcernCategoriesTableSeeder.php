<?php

use Illuminate\Database\Seeder;

class MtbConcernCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        DB::table('mtb_concern_categories')->truncate();
        DB::table('mtb_concern_categories')->insert([
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
                'name' => '口元・唇',
                'parent_id' => null
            ], [
                'name' => '審美歯科・歯科矯正',
                'parent_id' => null
            ], [
                'name' => 'その他',
                'parent_id' => null
            ], [
                'name' => '一重',
                'parent_id' => 1
            ], [
                'name' => '奥二重',
                'parent_id' => 1
            ], [
                'name' => '二重の左右左',
                'parent_id' => 1
            ], [
                'name' => '二重幅が狭い',
                'parent_id' => 1
            ], [
                'name' => '目が小さい',
                'parent_id' => 1
            ], [
                'name' => 'まぶたが暑い・重い',
                'parent_id' => 1
            ], [
                'name' => '離れ目',
                'parent_id' => 1
            ], [
                'name' => '蒙古襞が張っている',
                'parent_id' => 1
            ], [
                'name' => 'つり目・きつい目つき',
                'parent_id' => 1
            ], [
                'name' => '二重幅が広い',
                'parent_id' => 1
            ], [
                'name' => '眠そうな目・目の開きが悪い',
                'parent_id' => 1
            ], [
                'name' => '目の下のくま',
                'parent_id' => 1
            ], [
                'name' => '下まぶたのたるみ',
                'parent_id' => 1
            ], [
                'name' => '鼻が低い',
                'parent_id' => 2
            ], [
                'name' => '鼻が短い',
                'parent_id' => 2
            ], [
                'name' => '鼻先が丸い・団子鼻',
                'parent_id' => 2
            ], [
                'name' => '鼻先が低い',
                'parent_id' => 2
            ], [
                'name' => '鼻の下が長い',
                'parent_id' => 2
            ], [
                'name' => '鼻が大きい',
                'parent_id' => 2
            ], [
                'name' => '鼻筋が太い',
                'parent_id' => 2
            ], [
                'name' => '鷹鼻',
                'parent_id' => 2
            ], [
                'name' => '鼻が上を向いている',
                'parent_id' => 2
            ], [
                'name' => 'あごがない',
                'parent_id' => 3
            ], [
                'name' => 'くま',
                'parent_id' => 3
            ], [
                'name' => 'しわ・たるみ',
                'parent_id' => 3
            ], [
                'name' => 'エイジングケア',
                'parent_id' => 3
            ], [
                'name' => '肌のハリ・ツヤ',
                'parent_id' => 3
            ], [
                'name' => 'ホクロ取りたい',
                'parent_id' => 3
            ], [
                'name' => 'ニキビ・ニキビ跡',
                'parent_id' => 3
            ], [
                'name' => '肌荒れ・肌の不調',
                'parent_id' => 3
            ], [
                'name' => '毛穴',
                'parent_id' => 3
            ], [
                'name' => 'シミ・くすみ',
                'parent_id' => 3
            ], [
                'name' => '赤ら顔',
                'parent_id' => 3
            ], [
                'name' => '美白になりたい',
                'parent_id' => 3
            ], [
                'name' => '肝斑(かんぱん)',
                'parent_id' => 3
            ], [
                'name' => 'リフトアップ',
                'parent_id' => 3
            ], [
                'name' => 'あごがない',
                'parent_id' => 4
            ], [
                'name' => '顔を小さくしたい',
                'parent_id' => 4
            ], [
                'name' => '口元の形を変えたい',
                'parent_id' => 4
            ], [
                'name' => 'エラが張っている',
                'parent_id' => 4
            ], [
                'name' => '頬骨が出ている',
                'parent_id' => 4
            ], [
                'name' => '輪郭の脂肪',
                'parent_id' => 4
            ], [
                'name' => 'リフトアップ',
                'parent_id' => 4
            ], [
                'name' => '輪郭を整えたい',
                'parent_id' => 4
            ], [
                'name' => '立体的なフェイスラインにしたい',
                'parent_id' => 4
            ], [
                'name' => '額を丸くしたい',
                'parent_id' => 4
            ], [
                'name' => '面長',
                'parent_id' => 4
            ], [
                'name' => '歯茎が見える',
                'parent_id' => 4
            ], [
                'name' => '二の腕の脂肪',
                'parent_id' => 5
            ], [
                'name' => '太ももの脂肪',
                'parent_id' => 5
            ], [
                'name' => 'お腹の脂肪',
                'parent_id' => 5
            ], [
                'name' => 'お尻の垂れている',
                'parent_id' => 5
            ], [
                'name' => 'ふくらはぎの脂肪',
                'parent_id' => 5
            ], [
                'name' => '胸を大きくしたい',
                'parent_id' => 6
            ], [
                'name' => '胸の形を治したい',
                'parent_id' => 6
            ], [
                'name' => '乳房を小さくしたい',
                'parent_id' => 6
            ], [
                'name' => '唇が薄い',
                'parent_id' => 7
            ], [
                'name' => '鼻の下が長い',
                'parent_id' => 7
            ], [
                'name' => '口角をあげたい',
                'parent_id' => 7
            ], [
                'name' => '唇の形を変えたい',
                'parent_id' => 7
            ], [
                'name' => '歯茎が見える',
                'parent_id' => 7
            ], [
                'name' => '口元が出ている・受け口',
                'parent_id' => 7
            ], [
                'name' => '歯並びを良くしたい',
                'parent_id' => 8
            ], [
                'name' => '歯を白くしたい',
                'parent_id' => 8
            ], [
                'name' => '口元が出ている・受け口',
                'parent_id' => 8
            ], [
                'name' => '虫歯を治したい',
                'parent_id' => 8
            ],  [
                'name' => 'インプラントにしたい',
                'parent_id' => 8
            ], [
                'name' => 'ムダ毛',
                'parent_id' => 9
            ], [
                'name' => '脇汗を止めたい',
                'parent_id' => 9
            ], [
                'name' => 'タトゥーを消したい',
                'parent_id' => 9
            ], [
                'name' => '傷跡を綺麗にしたい',
                'parent_id' => 9
            ], [
                'name' => 'ピアスを開けたい',
                'parent_id' => 9
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
