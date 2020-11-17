<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuesionerLogic extends Model
{
    protected $table = 'kuesioner_logic';   
    public $timestamps = false;

    public function ref()
    {
        return $this->belongsTo('App\Models\Kuesioner', 'kuesioner_id_ref');
    }

    public function refItem()
    {
        return $this->belongsTo('App\Models\KuesionerAnswerMultipleChoice', 'kueswer_multiple_choice_itm_id');
    }
}
