<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menus')->truncate();
        //
        // DB::table('menus')->insert([
        //     [
        //         'name' => 'メニュー１',
        //         'speciality_id' => 'TREAT'
        //     ], [
        //         'name' => '施術の仕上がりに満足していますか？',
        //         'type' => 'TREAT'
        //     ], [
        //         'name' => '施術の料金は妥当でしたか？',
        //         'type' => 'TREAT'
        //     ], [
        //         'name' => '院内の雰囲気、設備、清潔感はいかがでしたか？',
        //         'type' => 'CLINIC'
        //     ], [
        //         'name' => 'スタッフの対応はいかがでしたか？',
        //         'type' => 'CLINIC'
        //     ], [
        //         'name' => 'プライバシーへの配慮はいかがでしたか？',
        //         'type' => 'CLINIC'
        //     ], [
        //         'name' => '治療前の説明は十分でしたか？',
        //         'type' => 'DOCTOR'
        //     ], [
        //         'name' => 'ご自分の要望・意見を考慮してもらえましたか？',
        //         'type' => 'DOCTOR'
        //     ], [
        //         'name' => '術前、術中、術後の対応はいかがでしたか？',
        //         'type' => 'DOCTOR'
        //     ]
        // ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
