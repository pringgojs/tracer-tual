<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class SurveySettingDashboard extends Model
{
    protected $table = 'survey_Setting_dashboard';   
    public $timestamps = false;

    public function kuesioner()
    {
        return $this->belongsTo('App\Models\Survey\SurveyKuesioner', 'kuesioner_id');
    }
}
