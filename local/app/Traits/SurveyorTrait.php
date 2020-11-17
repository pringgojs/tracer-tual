<?php

namespace App\Traits;

trait SurveyorTrait
{
    public function surveyor()
    {
        return $this->hasOne('App\Models\Surveyor', 'user_id');
    }
}