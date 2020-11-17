<?php

namespace App\Http\Controllers\UserSurvey;

use Illuminate\Http\Request;
use App\Models\Survey\Survey;
use App\Helpers\UserSurveyHelper;
use App\Http\Controllers\Controller;

class CompanyAccountController extends Controller
{
    public function index()
    {
        $view = view('user-survey.company-account.index');
        $view->list_company_account = Survey::all();
        return $view;
    }

    public function create()
    {
        $view = view('user-survey.company-account.create');
        return $view;
    }

    public function edit($id)
    {
        if (Survey::findOrFail($id)->status_account == 1) {
            return redirect('user-survey/company-account');
        }

        $view = view('user-survey.company-account.edit');
        $view->company_account = Survey::findOrFail($id);
        return $view;
    }

    public function store(Request $request)
    {
        UserSurveyHelper::createCompanyAccount($request);
        toaster_success('create form success');
        return redirect('user-survey/company-account');
    }

    public function update(Request $request, $id)
    {
        UserSurveyHelper::createCompanyAccount($request, $id);
        toaster_success('update form success');
        return redirect('user-survey/company-account');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $survey = Survey::findOrFail($id);
        $survey->delete();
        
        \DB::commit();

        toaster_success('delete form success');
        return redirect('user-survey/company-account');
    }
}
