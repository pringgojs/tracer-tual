<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\ScheduleDetail;

class TracerHelper
{
    public static function getSchedule()
    {
        $schedule = Schedule::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();
        if (! $schedule) return null;

        return $schedule;
    }

    public static function createSchedule($request, $id="")
    {
        \DB::beginTransaction();
        $tahun_lulus = $request->input('tahun_lulus');
        $program_study = $request->input('program_studies');
        $program = $request->input('programs');
        
        $schedule = $id ? Schedule::find($id) : new Schedule;
        $schedule->start_date = $request->input('start_date');
        $schedule->end_date = $request->input('end_date');
        $schedule->description = $request->input('description');
        $schedule->save();

        if ($id) {
            ScheduleDetail::where('schedule_id', $id)->delete();
        }

        for ($i=0; $i<count($program_study); $i++) {
            $detail = new ScheduleDetail;
            $detail->schedule_id = $schedule->id;
            $detail->tahun_lulus = $tahun_lulus[$i];
            $detail->generation = $tahun_lulus[$i];
            $detail->program_study_id = $program_study[$i];
            $detail->program_id = $program[$i];
            $detail->save();
        }

        \DB::commit();
    }
    
}
