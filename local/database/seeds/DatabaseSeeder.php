<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(KuesionerGroupSeeder::class);
        $this->call(KuesionerModelAnswerSeeder::class);
        $this->call(PeriodeSeeder::class);
        if (\App::environment('local')) {
            $this->call(AlumnusSeeder::class);
            $this->call(KuesionerSeeder::class);
            $this->call(KuesionerPeriodeSeeder::class);
        }
    }
}
