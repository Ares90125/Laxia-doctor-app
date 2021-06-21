<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PatientInfo;
use App\Models\Reservation;
use App\Models\RsvHopeTime;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::table('patients')->truncate();
        DB::table('patient_infos')->truncate();
        DB::table('reservations')->truncate();
        DB::table('rsv_hope_times')->truncate();

        $faker = \Faker\Factory::create('ja_JP');

        $clinic = User::create([
            'name' => 'クリニック１',
            'email' => 'clinic1@test.com',
            'password' => bcrypt('123123123'),
            'role' => 'clinic'
        ]);

        for($i = 0; $i <= 50; $i++):
            $user = User::create([
                'name' => '患者_' . $i,
                'email' => 'patient_' . $i . '@test.com',
                'password' => bcrypt('123123123'),
                'role' => 'patient'
            ]);
            $patient = $user->patient()->update([
                'name' => '患者_' . $i,
                'kana' => 'カンジャ_' . $i,
                'gender' => random_int(0, 1) == 1 ? 'female' : 'male',
                'phone_number' => $faker->e164PhoneNumber,
                'birthday' => $faker->date
            ]);
            
            $patientInfo = $user->patient->info()->create([
                'name01' => $faker->firstName,
                'name02' => $faker->lastName,
                'kana01' => 'テスト',
                'kana02' => 'テスト',
                'birthday' => $faker->date,
                'gender' => random_int(0, 1) == 1 ? 'female' : 'male',
                'phone_number' => $faker->e164PhoneNumber,
            ]);
            $reservation = Reservation::create([
                'patient_info_id' => $patientInfo->id,
                'clinic_id' => 1,
                'status' => 5,
                'source' => random_int(0, 1) == 1 ? 5 : 10,
                'hope_treat' => random_int(0, 1),
                'is_visited' => random_int(0, 1),
                'note' => '質問が入ります。'
            ]);
            for ($j = 0; $j < 5; $j++) {
                RsvHopeTime::create([
                    'reservation_id' => $reservation->id,
                    'date' => $faker->date,
                    'start_time' => $faker->time('H:i:s', '23:59:59'),
                    'end_time' => $faker->time('H:i:s', '23:59:59'),
                ]);
            }
        endfor;
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
