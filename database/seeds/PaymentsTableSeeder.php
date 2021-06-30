<?php

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Withdraw;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('payments')->truncate();
        DB::table('withdraws')->truncate();

        $faker = \Faker\Factory::create('ja_JP');

        for ($i = 1; $i < 25; $i++) {
            $ym = Carbon::now()->subMonths($i)->format('Y-m');
            Withdraw::create([
                'clinic_id' => 1,
                'month' => $ym,
                'price' => $faker->numberBetween(10000, 1000000),
                'paid_at' => "{$ym}-28 12:00:00"
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
