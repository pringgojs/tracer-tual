<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';   
    public $timestamps = false;

    public function scopeJoinClass($q)
    {
        $q->join('class', 'class.nomor', '=', $this->table.'.kelas');
    }

    public function scopeJoinProgramStudy($q)
    {
        $q->join('study_programs', 'study_programs.nomor', '=', 'class.jurusan');
    }


    public function classes()
    {
        return $this->belongsTo('App\Models\Classes', 'kelas');
    }

    public function ipk()
    {
        $carbon = new Carbon($this->tgllulus);
        // $semester = 1;
        // if ($carbon->month > 3 && $carbon->month <= 9) {
        //     $semester = 2;
        // }
        $ipk = \DB::select("select fipk_jam(".$carbon->year.", ".$this->semester_lulus." ,nomor) as ipk from STUDENTS where nrp='".$this->nrp."'");
        return $ipk[0]->ipk;
    }
}
