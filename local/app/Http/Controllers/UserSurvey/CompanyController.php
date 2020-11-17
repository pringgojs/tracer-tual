<?php

namespace App\Http\Controllers\UserSurvey;

use Illuminate\Http\Request;
use App\Models\Survey\Survey;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $view = view('user-survey.company.index');
        $view->list_company = Survey::company()->paginate(100);

        return $view;
    }
}
