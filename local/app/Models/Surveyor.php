<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surveyor extends Model
{
    protected $table = 'surveyors';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function programStudy()
    {
        return $this->belongsTo('App\Models\ProgramStudy', 'program_study_id');
    }
}
