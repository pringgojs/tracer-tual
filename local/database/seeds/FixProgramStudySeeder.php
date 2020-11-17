<?php

use App\Models\Alumni;
use App\Models\Student;
use Illuminate\Database\Seeder;

class FixProgramStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();
        $alumnis = Alumni::all();
        foreach ($alumnis as $alumni)
        {
            $student = Student::where('nrp', $alumni->nrp)->first();
            $alumni->program_study = $student->classes->jurusan;
            $alumni->save();
        }
        \DB::commit();
    }
}
