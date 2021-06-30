<?php

use Illuminate\Database\Seeder;

class MasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        DB::table('mtb_diary_rate_questions')->truncate();
        DB::table('mtb_diary_rate_questions')->insert([
            [
                'name' => '施術前の説明は十分でしたか？',
                'type' => 'treat'
            ], [
                'name' => '施術の仕上がりに満足していますか？',
                'type' => 'treat'
            ], [
                'name' => '施術の料金は妥当でしたか？',
                'type' => 'treat'
            ], [
                'name' => '院内の雰囲気、設備、清潔感はいかがでしたか？',
                'type' => 'clinic'
            ], [
                'name' => 'スタッフの対応はいかがでしたか？',
                'type' => 'clinic'
            ], [
                'name' => 'プライバシーへの配慮はいかがでしたか？',
                'type' => 'clinic'
            ], [
                'name' => '治療前の説明は十分でしたか？',
                'type' => 'doctor'
            ], [
                'name' => 'ご自分の要望・意見を考慮してもらえましたか？',
                'type' => 'doctor'
            ], [
                'name' => '術前、術中、術後の対応はいかがでしたか？',
                'type' => 'doctor'
            ]
        ]);


        DB::table('mtb_diary_text_questions')->truncate();
        DB::table('mtb_diary_text_questions')->insert([
            [
                'name' => 'どんなことで悩んでいましたか？',
                'sort_no' => 0
            ], [
                'name' => 'クリニック、ドクターを選択した理由は？',
                'sort_no' => 1
            ], [
                'name' => 'このメニューを選んだ理由は？',
                'sort_no' => 2
            ], [
                'name' => '施術の流れや施術中の痛みは？',
                'sort_no' => 3
            ], [
                'name' => 'ドクターやスタッフの対応はどうでしたか？',
                'sort_no' => 4
            ], [
                'name' => 'この施術をしたいと思ってる人へアドバイスを',
                'sort_no' => 5
            ]
        ]);

        DB::table('mtb_specialities')->truncate();
        DB::table('mtb_specialities')->insert([
            [
                'name' => '二重・目元整形',
                'sort_no' => 0
            ], [
                'name' => '小顔整形・フェイスライン',
                'sort_no' => 1
            ], [
                'name' => '若返り・エイジングケア',
                'sort_no' => 2
            ], [
                'name' => '鼻整形',
                'sort_no' => 3
            ], [
                'name' => '美容皮膚科',
                'sort_no' => 4
            ], [
                'name' => 'レーザー脱毛',
                'sort_no' => 5
            ], [
                'name' => 'シワ取り',
                'sort_no' => 6
            ], [
                'name' => '医療レーザー外来',
                'sort_no' => 7
            ], [
                'name' => '脂肪吸引',
                'sort_no' => 8
            ], [
                'name' => '豊胸施術',
                'sort_no' => 9
            ], [
                'name' => 'ワキガ・多汗症治療',
                'sort_no' => 10
            ], [
                'name' => '婦人科形成',
                'sort_no' => 11
            ], [
                'name' => 'タトゥー除去',
                'sort_no' => 12
            ], [
                'name' => 'アートメイク',
                'sort_no' => 13
            ], [
                'name' => 'AGA',
                'sort_no' => 14
            ], [
                'name' => 'FAGA',
                'sort_no' => 15
            ], [
                'name' => '審美歯科',
                'sort_no' => 16
            ], [
                'name' => '美容点滴・注射',
                'sort_no' => 17
            ], [
                'name' => '不妊治療',
                'sort_no' => 18
            ], [
                'name' => 'レーシック・ICL',
                'sort_no' => 19
            ], [
                'name' => '下肢静脈瘤',
                'sort_no' => 20
            ]
        ]);

        DB::table('mtb_treat_indicators')->truncate();
        DB::table('mtb_treat_indicators')->insert([
            [
                'name' => '痛み',
                'sort_no' => 0
            ], [
                'name' => '腫れ',
                'sort_no' => 1
            ], [
                'name' => '傷あと',
                'sort_no' => 2
            ]
        ]);

        DB::table('mtb_rsv_contents')->truncate();
        DB::table('mtb_rsv_contents')->insert([
            [
                'name' => 'カウンセリング',
                'sort_no' => 0
            ], [
                'name' => '施術',
                'sort_no' => 1
            ], [
                'name' => '術後検査',
                'sort_no' => 2
            ], [
                'name' => '施術・カウンセリング',
                'sort_no' => 3
            ]
        ]);

        DB::table('mtb_jobs')->truncate();
        DB::table('mtb_jobs')->insert([
            [
                'name' => '医師',
                'sort_no' => 0
            ], [
                'name' => 'スタッフ',
                'sort_no' => 1
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
