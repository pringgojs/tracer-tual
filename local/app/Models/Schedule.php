<?php

namespace App\Models;

use App\Models\Program;
use App\Models\ProgramStudy;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';   
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany('App\Models\ScheduleDetail', 'schedule_id');
    }

    public function generation()
    {
        $generations = explode(',', $this->generation);
        for ($i=0; $i<count($generations); $i++) {
            echo '<label>- '.$generations[$i].'</label><br>';
        }
    }

    public function departement()
    {
        $programs = explode(',', $this->program_study);
        $programs_study = ProgramStudy::whereIn('nomor', $programs)->get();
        $i = 1;
        foreach ($programs_study as $program) {
            if ($i > 3) {
                $url = url('schedule/'.$this->id.'/detail-department');
                echo '<a onclick=showDetail("'.$url.'") href="#" data-toggle="tooltip" data-original-title="Tampilkan lebih banyak"> <b>+Tampilkan lebih banyak</b></a>';
                return false;
            }
            echo '<label>- '.$program->jurusan_lengkap.'</label><br>';
            $i++;
        }
    }

    public function programStudy()
    {
        $programs = explode(',', $this->program);
        $programs_study = Program::whereIn('nomor', $programs)->get();
        $i = 1;
        foreach ($programs_study as $program) {
            if ($i > 3) {
                $url = url('schedule/'.$this->id.'/detail-program-study');
                echo '<a onclick=showDetail("'.$url.'") href="#" data-toggle="tooltip" data-original-title="Tampilkan lebih banyak"> <b>+Tampilkan lebih banyak</b></a>';
                return false;
            }
            echo '<label>- '.$program->program . ' ' .$program->keterangan.'</label><br>';
            $i++;
        }
    }
}
