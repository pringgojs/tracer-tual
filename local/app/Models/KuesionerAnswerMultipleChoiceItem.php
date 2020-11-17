<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuesionerAnswerMultipleChoiceItem extends Model
{
    protected $table = 'kueswer_multiple_choice_item';
    public $timestamps = false;

    public static function insertData($kuesioner_id, $notes_answer, $value, $id="")
    {
        $item = new KuesionerAnswerMultipleChoiceItem;
        if ($id) {
            $item = KuesionerAnswerMultipleChoiceItem::find($id);
        }

        $item->kuesioner_id = $kuesioner_id;
        $item->notes = $notes_answer;
        $item->value = $value;
        $item->save();
    }
}
