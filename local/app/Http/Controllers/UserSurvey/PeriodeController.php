<?php

namespace App\Http\Controllers\UserSurvey;

use Illuminate\Http\Request;
use App\Helpers\UserSurveyHelper;
use App\Http\Controllers\Controller;
use App\Models\Survey\SurveyPeriode;

class PeriodeController extends Controller
{
    public function index()
    {
        $view = view('user-survey.periode.index');
        $view->list_periode = SurveyPeriode::all();
        return $view;
    }

    public function create()
    {
        $view = view('user-survey.periode.create');
        return $view;
    }

    public function edit($id)
    {
        $view = view('user-survey.periode.edit');
        $view->periode = SurveyPeriode::findOrFail($id);
        return $view;
    }

    public function store(Request $request)
    {
        UserSurveyHelper::createPeriode($request);
        toaster_success('create form success');
        return redirect('user-survey/periode');
    }

    public function update(Request $request, $id)
    {
        UserSurveyHelper::createPeriode($request, $id);
        toaster_success('update form success');
        return redirect('user-survey/periode');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $period = SurveyPeriode::findOrFail($id);
        $period->delete();
        
        \DB::commit();

        toaster_success('delete form success');
        return redirect('user-survey/periode');
    }
}
