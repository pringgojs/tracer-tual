<?php

namespace App\Http\Controllers\SurveyStackholder;

use Illuminate\Http\Request;
use App\Models\Survey\Survey;
use App\Models\Survey\SurveyAnswer;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $view = view('survey-stackholder.company.index');
        $view->list_company = Survey::my()->company()->paginate(100);

        return $view;
    }

    public function detail($id)
    {
        $view = view('survey-stackholder.company.detail');
        $view->company = Survey::findOrFail($id);
        $view->list_survey_answer = SurveyAnswer::where('survey_id', $id)->get();
        return $view;
    }

    public function download($id)
    {
        $company = Survey::findOrFail($id);
        $name = $company->company_name;
        if (strlen($name) > 31) {
            $name = substr($name, 0, 29);
        }
        \Excel::create($name, function ($excel) use ($company, $name) {
                    
            $excel->sheet($name, function ($sheet) use ($company) {
                $sheet->setWidth(array(
                    'A' => 25,
                    'B' => 25,
                    'C' => 25,
                ));

                $list_survey_answer = SurveyAnswer::where('survey_id', $company->id)->get();

                $data = array(array('NO', 'PERTANYAAN', 'JAWABAN'));
                $array_inserted = [];
                foreach ($list_survey_answer as $row => $answer) {
                    array_push($data, [++$row, $answer->kuesioner->kuesioner, $answer->kuesionerAnswer->notes]);
                }
                
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xls');

        return redirect()->back();
    }
}
