<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniAnswerMultipleChoiceItem extends Model
{
    protected $table = 'answer_multiple_choice_item';   
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo('App\Models\KuesionerAnswerMultipleChoiceItem', 'kueswer_multiple_choice_itm_id');
    }
}
