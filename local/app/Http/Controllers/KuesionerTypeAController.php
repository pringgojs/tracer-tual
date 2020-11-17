<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use App\Models\KuesionerGroup;
use App\Exceptions\AppException;
use App\Helpers\KuesionerHelper;
use App\Models\KuesionerModelAnswer;
use App\Models\KuesionerAnswerMultipleChoice;

class KuesionerTypeAController extends Controller
{
    public function index()
    {
        $view = view('kuesioner.index');
        $view->list_kuesioner = Kuesioner::all();
        
        return $view;
    }

    public function create() 
    {
        $view = view('kuesioner.A.create');
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner_model_answer = KuesionerModelAnswer::all();
        $view->list_kuesioner_model_c = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        return $view;
    }

    public function edit($id) 
    {
        $view = view('kuesioner.A.edit');
        $view->kuesioner = Kuesioner::findOrFail($id);
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner_model_c = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        
        return $view;
    } 

    public function store(Request $request)
    {
        if (!KuesionerHelper::validateKuesionerTypeAB($request)) {
            toaster_error('Please, fill the blank form');
            return redirect('kuesioner/A/create')
                ->withInput();
        }
        
        \DB::beginTransaction();
        KuesionerHelper::kuesionerTypeAB($request, 1);
        \DB::commit();

        toaster_success('create form success');
        return redirect('kuesioner/A/create');
    }

    public function update(Request $request, $id)
    {
    
        if (!KuesionerHelper::validateKuesionerTypeAB($request)) {
            toaster_error('Please, fill the blank form');
            return redirect('kuesioner/A/'.$id.'/edit')
                ->withInput();
        }

        \DB::beginTransaction();
        KuesionerHelper::kuesionerTypeAB($request, 1, $id);
        \DB::commit();
        
        toaster_success('update form success');
        return redirect('kuesioner');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $kuesioner = Kuesioner::findOrFail($id);
        $kuesioner->delete();
        
        \DB::commit();

        toaster_success('delete form success');
        return redirect('kuesioner');
    }
}
