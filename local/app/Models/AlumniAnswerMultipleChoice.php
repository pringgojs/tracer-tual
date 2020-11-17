<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniAnswerMultipleChoice extends Model
{
    protected $table = 'alumni_answer_multiple_choice';   
    public $timestamps = false;

    public function scopeJoinAlumniAnswer($q)
    {
        $q->join('alumni_answer', 'alumni_answer.id', '=', $this->table.'.alumni_answer_id');
    }

    public function scopeJoinAlumni($q)
    {
        $q->join('alumni', 'alumni.id', '=', 'alumni_answer.alumni_id');
    }

    public function scopeJoinStudent($q)
    {
        $q->join('students', 'students.nrp', '=', 'alumni_answer.nrp');
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

    public function kuesionerAnswer()
    {
        return $this->belongsTo('App\Models\KuesionerAnswerMultipleChoice', 'kueswer_multiple_choice_id');
    }
}
