<?php

namespace App\Helpers;

use Validator;
use App\Models\Kuesioner;
use App\Models\KuesionerLogic;
use App\Models\KuesionerAnswerMultipleChoice;

class KuesionerHelper
{
    # Insert into table Kuesioner
    public static function insertKuesioner($request, $model_answer, $id='')
    {
        $kuesioner = new Kuesioner();
        if ($id) {
            $kuesioner = Kuesioner::find($id);
        }

        $kuesioner->kuesioner = $request->input('kuesioner');
        $kuesioner->kuesioner_model_answer_id = $model_answer;
        $kuesioner->kuesioner_group_id = $request->input('group');
        $kuesioner->is_required = $request->input('is_required') ? : 0;
        $kuesioner->is_published = $request->input('status') ? : 0;
        $kuesioner->type_of_field = $request->input('type_of_field') ? : null;
        $kuesioner->order_number = $request->input('order_number');
        $kuesioner->is_use_logic = $request->input('is_logic') ? : 0;
        $kuesioner->add_other_answer = $request->input('add_other_answer') ? : 0;
        $kuesioner->created_at = date('Y-m-d h:i:s');
        $kuesioner->updated_at = null;
        $kuesioner->save();

        return $kuesioner;
    }

    # Insert into kuesioner Logic
    public static function insertKuesionerLogic($kuesioner, $request)
    {
        $action_logic_kuesioner = $request->input('action_logic_kuesioner');
        $action_logic_kuesioner_item = $request->input('action_logic_kuesioner_item');

        if ($kuesioner->is_use_logic) {
            for ($i=0; $i< count($action_logic_kuesioner); $i++) {
                if (isset($action_logic_kuesioner[$i]) && isset($action_logic_kuesioner_item[$i])) {
                    $kuesioner_logic = KuesionerLogic::where('kuesioner_id', $kuesioner->id)
                        ->where('kuesioner_id_ref', $action_logic_kuesioner[$i])
                        ->where('kueswer_multiple_choice_itm_id', $action_logic_kuesioner_item[$i])
                        ->first() ? : new KuesionerLogic;

                    $kuesioner_logic->kuesioner_id = $kuesioner->id;
                    $kuesioner_logic->kuesioner_id_ref = $action_logic_kuesioner[$i];
                    $kuesioner_logic->operator = '=';
                    $kuesioner_logic->kueswer_multiple_choice_itm_id = $action_logic_kuesioner_item[$i];
                    $kuesioner_logic->type = 'show';
                    $kuesioner_logic->save();
                    
                }
                
            }

            return true;
        }

        // If not use logic, so its delete from database
        $kuesioner_logic = KuesionerLogic::where('kuesioner_id', $kuesioner->id)->first();
        if ($kuesioner_logic) {
            $kuesioner_logic->delete();
        }
        
        return true;
    }

    # Kuesioner Type AB { insert and update}
    public static function kuesionerTypeAB($request, $model_answer, $id='')
    {
        $kuesioner = self::insertKuesioner($request, $model_answer, $id);
        self::insertKuesionerLogic($kuesioner, $request);
    }

    public static function validateKuesionerTypeAB($request) {
        if ($request->input('is_logic')) {
            $validator = Validator::make($request->all(), [
                'action_logic_kuesioner' => 'required',
                'action_logic_kuesioner_item' => 'required',
            ]);
            
            if ($validator->fails()) {
                return false;
            }
        }

        return true;
    }

    # Kuesioner type C { insert and update}
    public static function kuesionerTypeC($request, $model_answer, $id='')
    {
        $kuesioner = self::insertKuesioner($request, $model_answer, $id);
        self::insertKuesionerLogic($kuesioner, $request, $id);
        
        # Insert ne child
        $list_answer  = $request->input('answer');
        $item_id  = $request->input('item_id');
        for ($i = 0; $i < count($list_answer); $i++) {
            $id = isset($item_id[$i]) ?  $item_id[$i] : null;
            KuesionerAnswerMultipleChoice::insertData($kuesioner->id, $request->input('answer')[$i], $id);
        }
    }
}