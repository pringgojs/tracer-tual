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

class KuesionerTypeCController extends Controller
{
    public function index()
    {
        $view = view('kuesioner.index');
        $view->list_kuesioner = Kuesioner::all();
        
        return $view;
    }

    public function create() 
    {
        $view = view('kuesioner.C.create');
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner_model_answer = KuesionerModelAnswer::all();
        $view->list_kuesioner_model_c = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        return $view;
    }

    public function edit($id) 
    {
        $view = view('kuesioner.C.edit');
        $view->kuesioner = Kuesioner::findOrFail($id);
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner_model_c = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        $view->list_kuesioner_model_answer = KuesionerModelAnswer::all();

        return $view;
    } 

    public function store(Request $request)
    {
        \DB::beginTransaction();
        KuesionerHelper::kuesionerTypeC($request, 3);
        \DB::commit();

        toaster_success('create form success');
        return redirect('kuesioner/C/create');
    }

    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        KuesionerHelper::kuesionerTypeC($request, 3, $id);
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
