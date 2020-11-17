<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use App\Models\KuesionerGroup;
use App\Exceptions\AppException;
use App\Helpers\KuesionerHelper;
use App\Models\KuesionerModelAnswer;
use App\Models\KuesionerAnswerMultipleChoice;
use App\Models\KuesionerAnswerMultipleChoiceItem;

class KuesionerTypeDController extends Controller
{
    public function index()
    {
        $view = view('kuesioner.index');
        $view->list_kuesioner = Kuesioner::all();
        
        return $view;
    }

    public function create() 
    {
        $view = view('kuesioner.D.create');
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner_model_answer = KuesionerModelAnswer::all();
        $view->list_kuesioner_model_c = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        return $view;
    }

    public function edit($id) 
    {
        $view = view('kuesioner.D.edit');
        $view->kuesioner = Kuesioner::find($id);
        $view->list_group = KuesionerGroup::all();
        if (!$view->kuesioner) {
            throw new AppException("Sory, request can not be processed", 400);
        }
        $view->list_kuesioner_model_answer = KuesionerModelAnswer::all();
        $view->list_kuesioner_model_c = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        return $view;
    } 

    public function store(Request $request)
    {
        \DB::beginTransaction();
        $kuesioner = new Kuesioner();
        $kuesioner->kuesioner = $request->input('kuesioner');
        $kuesioner->kuesioner_model_answer_id = 4;
        $kuesioner->kuesioner_group_id = $request->input('group');
        $kuesioner->is_required = 1;
        $kuesioner->is_published = $request->input('status') ? : 0;
        $kuesioner->order_number = $request->input('order_number');
        $kuesioner->created_at = date('Y-m-d h:i:s');;
        $kuesioner->is_use_logic = $request->input('is_logic') ? : 0;
        $kuesioner->save();
        /** Logic */
        KuesionerHelper::insertKuesionerLogic($kuesioner, $request);

        /** Pertanyaan detail */
        $list_answer  = $request->input('questions');
        for ($i = 0; $i < count($list_answer); $i++) {
            $jawaban = new KuesionerAnswerMultipleChoice();
            $jawaban->kuesioner_id = $kuesioner->id;
            $jawaban->notes = $request->input('questions')[$i];
            $jawaban->save();
        }

        /** */
        $list_answer  = $request->input('notes_answer');
        for ($i = 0; $i < count($list_answer); $i++) {
            $jawaban = new KuesionerAnswerMultipleChoiceItem();
            $jawaban->kuesioner_id = $kuesioner->id;
            $jawaban->notes = $request->input('notes_answer')[$i];
            $jawaban->value = $request->input('value')[$i];
            $jawaban->save();
        }
        
        \DB::commit();
        toaster_success('create form success');
        return redirect('kuesioner/D/create');
    }

    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        $kuesioner = Kuesioner::find($id);
        $kuesioner->kuesioner = $request->input('kuesioner');
        $kuesioner->kuesioner_model_answer_id = 4;
        $kuesioner->kuesioner_group_id = $request->input('group');
        $kuesioner->is_required = 1;
        $kuesioner->is_published = $request->input('status') ? : 0;
        $kuesioner->order_number = $request->input('order_number');
        $kuesioner->updated_at = date('Y-m-d h:i:s');;
        $kuesioner->is_use_logic = $request->input('is_logic') ? : 0;
        $kuesioner->save();

        KuesionerHelper::insertKuesionerLogic($kuesioner, $request, $id);
        
        $list_answer  = $request->input('answer');
        $item_id  = $request->input('item_id');
        for ($i = 0; $i < count($list_answer); $i++) {
            $id = isset($item_id[$i]) ?  $item_id[$i] : null;
            KuesionerAnswerMultipleChoice::insertData($kuesioner->id, $list_answer[$i], $id);
        }

        $notes_answer  = $request->input('notes_answer');
        $answer_item_id  = $request->input('answer_item_id');
        $value  = $request->input('value');

        for ($i = 0; $i < count($notes_answer); $i++) {
            $id = isset($answer_item_id[$i]) ?  $answer_item_id[$i] : null;
            KuesionerAnswerMultipleChoiceItem::insertData($kuesioner->id, $notes_answer[$i], $value[$i], $id);
        }
        \DB::commit();
        toaster_success('update form success');
        return redirect('kuesioner');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $kuesioner = Kuesioner::find($id);
        $kuesioner->delete();
        
        \DB::commit();
        toaster_success('delete form success');
        return redirect('kuesioner');
    }
}
