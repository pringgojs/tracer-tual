<?php
namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Student;
use App\Models\Schedule;

class FrontHelper {
    
    /** mengambil periode user */
    public static function getPeriode($nrp)
    {
        $alumni = Student::where('nrp', $nrp)->first();
        $tgl_lulus = $alumni->tgllulus;
        if (!$tgl_lulus) {
            $tahun = $alumni->tahun_lulus;
            $semester_lulus = $alumni->semester_lulus;
            $tgl_lulus = $tahun.'-03-01';

            if ($semester_lulus == 2) {
                $tgl_lulus = $tahun.'-09-01';
            }
        }
        $date = Carbon::parse($tgl_lulus);
        $now = Carbon::now();
        $diff = $date->diffInMonths($now);
        $periode = Periode::where('lower_limit', '<=', $diff)
            ->where('upper_limit', '>=', $diff)
            ->first();
        
        if ($periode) return $periode;

        /**
         * If graduated_date > max of upper_limit ini table period, make it periode on max level 
         */
        $periode = Periode::where('upper_limit', \DB::raw("(select max(upper_limit) from periode)"))->first();
        if (!$periode) {
            // TODO block exception
            return null;
            // throw new AppException('Internal server error, period not set');
        }

        return $periode;
    }

    public static function getSchedule($student)
    {
        $schedule = Schedule::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if (\App::environment('local')) {
            return $schedule;
        }

        if (! $schedule) return null;
        $check = false;
        foreach($schedule->details as $detail) {
            if ($student->classes->program == $detail->program_id && $student->classes->jurusan == $detail->program_study_id && $student->tahun_lulus == $detail->tahun_lulus) {
                $check = true;
                break;
            }
        }

        if (!$check) return null;

        return $schedule;
    }

}