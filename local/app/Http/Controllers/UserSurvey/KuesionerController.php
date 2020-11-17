<?php

namespace App\Http\Controllers\UserSurvey;

use Illuminate\Http\Request;
use App\Helpers\UserSurveyHelper;
use App\Http\Controllers\Controller;
use App\Models\Survey\SurveyPeriode;
use App\Models\Survey\SurveyKuesioner;

class KuesionerController extends Controller
{
    public function index()
    {
        $view = view('user-survey.kuesioner.index');
        $view->list_kuesioner = SurveyKuesioner::orderBy('order_number', 'ASC')->paginate(100);
        return $view;
    }

    public function create()
    {
        $view = view('user-survey.kuesioner.create');
        $view->list_periode = SurveyPeriode::all();
        return $view;
    }

    public function store(Request $request)
    {
        UserSurveyHelper::createKuesioner($request);
        toaster_success('create form success');
        return redirect('user-survey/kuesioner');
    }

    public function edit($id)
    {
        $view = view('user-survey.kuesioner.edit');
        $view->kuesioner = SurveyKuesioner::findOrFail($id);
        $view->list_periode = SurveyPeriode::all();
        return $view;
    }

    public function copy($id)
    {
        $view = view('user-survey.kuesioner.copy');
        $view->kuesioner = SurveyKuesioner::findOrFail($id);
        $view->list_periode = SurveyPeriode::all();
        return $view;
    }

    public function update(Request $request, $id)
    {
        UserSurveyHelper::createKuesioner($request, $id);
        toaster_success('create form success');
        return redirect('user-survey/kuesioner');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $kuesioner = SurveyKuesioner::findOrFail($id);
        $kuesioner->delete();
        \DB::commit();

        toaster_success('delete form success');
        return redirect('user-survey/kuesioner');
    }

}
