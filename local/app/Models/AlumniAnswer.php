<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AlumniAnswerMultipleChoiceItem;
use App\Traits\ChartGeneratorKuesionerTrait;

class AlumniAnswer extends Model
{
    protected $table = 'alumni_answer';   
    public $timestamps = false;

    use ChartGeneratorKuesionerTrait;
    
    public function scopeJoinKuesioner($q)
    {
        $q->join('kuesioner', 'kuesioner.id', '=', 'alumni_answer.kuesioner_id');
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

    public function scopeJoinPeriode($q)
    {
        $q->join('periode', 'periode.id', '=', 'alumni_answer.periode_id');
    }

    public function scopeJoinAnswerDescription($q)
    {
        $q->join('alumni_answer_description', 'alumni_answer_description.alumni_answer_id', '=', 'alumni_answer.id');
    }

    public function scopeJoinAnswerMultipleChoice($q)
    {
        $q->join('alumni_answer_multiple_choice', 'alumni_answer_multiple_choice.alumni_answer_id', '=', 'alumni_answer.id');
    }

    public function scopeJoinAnswerMultipleChoiceItem($q)
    {
        $q->join('answer_multiple_choice_item', 'answer_multiple_choice_item.answer_id', '=', 'alumni_answer.id');
    }

    /**
     * Join another table with another table
     */
    public function scopeJoinKuesionerAnswerMultipleChoice($q)
    {
        $q->join('kueswer_multiple_choice', 'kueswer_multiple_choice.id', '=', 'alumni_answer_multiple_choice.kueswer_multiple_choice_id');
    }

    public function scopeJoinKuesionerGroup($q)
    {
        $q->join('kuesioner_group', 'kuesioner_group.id', '=', 'kuesioner.kuesioner_group_id');
    }

    public function kuesioner()
    {
        return $this->belongsTo('App\Models\Kuesioner', 'kuesioner_id');
    }

    public function periode()
    {
        return $this->belongsTo('App\Models\Periode', 'periode_id');
    }

    public function alumni()
    {
        return $this->belongsTo('App\Models\Alumni', 'alumni_id');
    }

    public function answerDescription()
    {
        return $this->hasOne('App\Models\AlumniAnswerDescription', 'alumni_answer_id');
    }

    public function answerDescriptionMulti()
    {
        return $this->hasMany('App\Models\AlumniAnswerDescription', 'alumni_answer_id');
    }

    public function answerMultipleChoice()
    {
        return $this->hasOne('App\Models\AlumniAnswerMultipleChoice', 'alumni_answer_id');
    }

    public function answerMultipleChoiceMulti()
    {
        return $this->hasMany('App\Models\AlumniAnswerMultipleChoice', 'alumni_answer_id');
    }

    public function answerMultipleChoiceItem()
    {
        return $this->hasMany('App\Models\AlumniAnswerMultipleChoiceItem', 'alumni_answer_id');
    }
}
