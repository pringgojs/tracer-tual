<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';   
    public $timestamps = true;

    public function scopeJoinAlumniAnswer($q)
    {
        $q->join('alumni_answer', 'alumni_answer.alumni_id', '=', $this->table.'.id');
    }

    public function scopeJoinAlumniAnswerMultipleChoice($q)
    {
        $q->join('alumni_answer', 'alumni_answer.id', '=', 'alumni_answer_multiple_choice.alumni_answer_id');
    }

    public function programStudy()
    {
        return $this->belongsTo('App\Models\ProgramStudy', 'program_study');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Program', 'jenjang');
    }

    public function alumniAnswer()
    {
        return $this->hasMany('App\Models\AlumniAnswer', 'alumni_id')->orderBy('id');
    }

    public function scopeJoinStudent($q)
    {
        $q->join('students', 'students.nrp', '=', 'alumni.nrp');
    }

    public function scopeJoinClass($q)
    {
        $q->join('class', 'class.nomor', '=', 'students.kelas');
    }

    public function scopeJoinProgramStudy($q)
    {
        $q->join('study_programs', 'study_programs.nomor', '=', 'class.jurusan');
    }

    public function scopeJoinProgram($q)
    {
        $q->join('programs', 'programs.nomor', '=', 'class.program');
    }


    public static function getTotal($request=null, $gender=null)
    {
        $alumni = self::joinAlumniAnswer()
            ->where(function($q) use ($request, $gender) {
                if ($request) {
                    if ($request['program_study'] != 0) {
                        $q->where('alumni.program_study', $request['program_study']);
                    }
    
                    if ($request['tahun_lulus'] != 0) {
                        $q->where('alumni.year_of_graduated', $request['tahun_lulus']);
                    }
    
                    if ($request['schedule'] != 0) {
                        $q->where('alumni_answer.schedule_id', $request['schedule']);
                    }
    
                    if ($request['program'] != 0) {
                        $q->where('alumni.jenjang', $request['program']);
                    }
                }
                if (in_array($gender, [0, 1], true)) {
                    $q->where('alumni.gender', $gender);
                }
                
            })
            ->select('alumni_answer.alumni_id')
            ->groupBy('alumni_answer.alumni_id')
            ->get()
            ->count();

        return $alumni;
    }
}
