<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KuesionerAnswerMultipleChoice;

class KuesionerAnswerMultipleChoice extends Model
{
    protected $table = 'kueswer_multiple_choice';
    public $timestamps = false;

    
    public static function insertData($kuesioner_id, $notes, $id="")
    {
        $item = new KuesionerAnswerMultipleChoice;
        if ($id) {
            $item = KuesionerAnswerMultipleChoice::find($id);
        }

        $item->kuesioner_id = $kuesioner_id;
        $item->notes = $notes;
        $item->save();
    }

    public static function getKuesionerRef($kuesioner_id, $kuesioner_ref_id)
    {
        return KuesionerAnswerMultipleChoice::where('kuesioner_id', $kuesioner_ref_id)
            ->where('kuesioner_id', '!=', $kuesioner_id)
            ->get();
    }
}
