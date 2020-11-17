<?php

namespace App\Models\Survey;

use App\Models\Survey\SurveyAnswer;
use App\Models\Survey\SurveyKuesioner;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    protected $table = 'survey_answers';   
    public $timestamps = true;

    public function kuesioner()
    {
        return $this->belongsTo('App\Models\Survey\SurveyKuesioner', 'kuesioner_id');
    }

    public function kuesionerAnswer()
    {
        return $this->belongsTo('App\Models\Survey\SurveyKuesionerDetail', 'kuesioner_answer_id');
    }

    public function scopeJoinSurvey($q)
    {
        $q->join('surveys', 'surveys.id', '=', 'survey_answers.survey_id');
    }

    public function scopeJoinKuesioner($q)
    {
        $q->join('survey_kuesioners', 'survey_kuesioners.id', '=', 'survey_answers.kuesioner_id');
    }

    public static function chart($kuesioner_id, $user_id, $filter = [])
    {
        $survey_answer = SurveyAnswer::joinSurvey()
            ->where('survey_answers.kuesioner_id', $kuesioner_id)
            ->where('surveys.created_by', $user_id)
            ->where(function ($q) use ($filter) {
                if ($filter) {
                    $periode = $filter['periode'];
                    if ($periode) {
                        $q->where('surveys.periode', $periode);
                    }
                }
            })
            ->selectRaw('survey_answers.kuesioner_answer_id, count(survey_answers.kuesioner_answer_id) as total')
            ->groupBy('survey_answers.kuesioner_answer_id')
            ->get();

        if (!$survey_answer) return [];
        return $survey_answer;
    }
}
