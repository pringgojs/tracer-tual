<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class SurveyKuesioner extends Model
{
    protected $table = 'survey_kuesioners';   
    public $timestamps = true;

    public function periode()
    {
        return $this->belongsTo('App\Models\Survey\SurveyPeriode', 'periode_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\Survey\SurveyKuesionerDetail', 'survey_kuesioner_id');
    }
}
