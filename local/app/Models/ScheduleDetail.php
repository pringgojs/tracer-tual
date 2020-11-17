<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    protected $table = 'schedule_details';   
    public $timestamps = false;

    public function programStudy()
    {
        return $this->belongsTo('App\Models\ProgramStudy', 'program_study_id');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Program', 'program_id');
    }
}
