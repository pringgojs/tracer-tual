<?php

namespace App\Http\Controllers\SurveyStackholder;

use Illuminate\Http\Request;
use App\Models\Survey\Survey;
use App\Models\Survey\SurveyAnswer;
use App\Http\Controllers\Controller;
use App\Models\Survey\SurveyKuesioner;
use App\Models\Survey\SurveySettingDashboard;

class HomeController extends Controller
{
    public function index()
    {
        $view = view('survey-stackholder.dashboard.index');
        $view->total_company = Survey::my()->company()->count();
        $view->total_company_account = Survey::my()->count();
        $view->total_kuesioner = SurveyKuesioner::all()->count();
        $view->list_kuesioner = SurveyKuesioner::all();
        $view->list_periode = Survey::my()->company()->select('periode')->groupBy('periode')->get();
        $view->layouts = SurveySettingDashboard::where('user_id', auth()->user()->id)->get();
        $view->filter = [];
        return $view;
    }

    public function filter(Request $request)
    {
        $view = view('survey-stackholder.dashboard._chart');
        $view->layouts = SurveySettingDashboard::all();
        $view->filter = $request->input();
        return $view;
    }

    public function storeLayout(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $layouts = SurveySettingDashboard::all();
        $i = 0;
        foreach ($layouts as $layout) {
            $setting = SurveySettingDashboard::where('kuesioner_id', $layout->kuesioner_id)->first();
            $setting->json_layout = serialize($data[$i]);
            $setting->save();
            $i++;
        }

        return 'saved';
    }

    public function download(Request $request)
    {
        $path = storage_path('app/public/export/');
        $file_name = 'DATA REPORT '.date('Ymd');
        $filter = $request->input() ? : [];
        \Excel::create($file_name, function ($excel) use ($filter) {
            $kuesioners = SurveyKuesioner::all();
            foreach ($kuesioners as $kuesioner) {
                $alumni_answer = SurveyAnswer::chart($kuesioner->id, auth()->user()->id, $filter);
                $question = $kuesioner->kuesioner;
                $header = array(array('NO', 'DATA', 'JUMLAH'));
                $excel->sheet('KUESIONER-'.$kuesioner->id, function ($sheet) use ($kuesioner, $question, $header, $alumni_answer) {
                    $sheet->setWidth(array(
                        'A' => 25,
                        'B' => 25,
                        'C' => 25,
                    ));

                    $sheet->cell('A1', function ($cell) use ($question) {
                        $cell->setValue($question);
                    });

                    $array_inserted = [];
                    foreach ($alumni_answer as $row => $answer) {
                        array_push($header, [$row+1, $answer->kuesionerAnswer->notes, $answer->total]);
                    }
                    
                    $sheet->fromArray($header, null, 'A3', false, false);
                });
            }
        })->store('xls', $path);
        return url('download/export/'.$file_name.'.xls');
    }
}
