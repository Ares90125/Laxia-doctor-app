<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(MasterTableSeeder::class);
        // $this->call(PatientTableSeeder::class);
        // $this->call(PaymentsTableSeeder::class);
        // $this->call(UserMasterTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(PrefsTableSeeder::class);
        $this->call(MtbConcernCategoriesTableSeeder::class);
    }
}
    