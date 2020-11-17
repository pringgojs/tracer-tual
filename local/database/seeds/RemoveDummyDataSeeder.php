<?php

use App\Models\Alumni;
use App\Models\TokenUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AlumniPeriodeAnswer;

class RemoveDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_nrp = array(
            '15617013',
            '15617003','15617004','15617004','15617002','15617007','15617016','15617021',
            '15617009','15617015','15617019', '15617012'
        );

        DB::beginTransaction();
        $delete_alumni = Alumni::whereIn('nrp', $array_nrp)->delete();
        $delete_alumni_periode_answer = AlumniPeriodeAnswer::whereIn('identity_id', $array_nrp)->delete();
        $token_user = TokenUser::whereIn('nrp', $array_nrp)->delete();
        DB::commit();
    }
}
