<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Periode;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\Kuesioner;
use App\Models\AlumniAnswer;
use App\Models\ProgramStudy;
use Illuminate\Http\Request;
use App\Helpers\NumberHelper;
use App\Models\SettingDashboardChart;
use App\Models\AlumniAnswerMultipleChoiceItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isRole('surveyor')) {
            return redirect('tracking');
        }

        if (auth()->user()->isRole('user.survey')) {
            return redirect('survey-stackholder');
        }
        
        $view = view('dashboard.home');
        $view->list_periode =  Periode::all();
        $view->total_boys = Alumni::getTotal(null, 1);
        $view->total_girls = Alumni::getTotal(null, 0);
        $view->total_alumni = Alumni::getTotal(null);
        $view->layouts = SettingDashboardChart::all();
        $view->program_studies = ProgramStudy::orderBy('jurusan')->get();
        $view->programs = Program::orderBy('nomor')->get();
        $view->tahun_lulus = Alumni::select('alumni.year_of_graduated')->groupBy('year_of_graduated')->get();
        $view->schedules = Schedule::all();
        $view->filter = [];
        return $view;
    }

    public function filter(Request $request)
    {
        $view = view('dashboard._chart');
        $view->layouts = SettingDashboardChart::all();
        $view->filter = $request->input();
        $view->total_boys = Alumni::getTotal($request->input(), 1);
        $view->total_girls = Alumni::getTotal($request->input(), 0);
        $view->total_alumni = Alumni::getTotal($request->input());
        return $view;
    }

    public function saveLayout(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $layouts = SettingDashboardChart::all();
        $i = 0;
        foreach ($layouts as $layout) {
            $setting = SettingDashboardChart::where('kuesioner_id', $layout->kuesioner_id)->first();
            $setting->kuesioner_id = $layout->kuesioner_id;
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
        $filter = $request->input();
        \Excel::create($file_name, function ($excel) use ($filter) {
            $kuesioners = Kuesioner::all();
            foreach ($kuesioners as $kuesioner) {
                $alumni_answer = AlumniAnswer::chart($kuesioner->id, $filter) ? : [];
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

                    $sheet->cell('A2', function ($cell) use ($kuesioner) {
                        $cell->setValue($kuesioner->showLogic($kuesioner, 1));
                    });

                    $array_inserted = [];
                    if ($kuesioner->kuesioner_model_answer_id == 1) {
                        foreach ($alumni_answer as $row => $answer) {
                            array_push($header, [$row+1, $answer->description, $answer->total]);
                        }
                    } else if ($kuesioner->kuesioner_model_answer_id == 2) {
                        foreach ($alumni_answer as $row => $answer) {
                            array_push($header, [$row+1, $answer->description, $answer->total]);
                        }
                    } else if ($kuesioner->kuesioner_model_answer_id == 3 || $kuesioner->kuesioner_model_answer_id == 5) {

                        foreach ($alumni_answer as $row => $answer) {
                            if (!$answer->kuesionerAnswer) continue;
                            array_push($header, [$row+1, $answer->kuesionerAnswer->notes, $answer->total]);
                        }
                    } else if ($kuesioner->kuesioner_model_answer_id == 4) {
                        $i = 1;
                        $total = 0;
                        foreach ($kuesioner->multipleChoice as $item) {
                            $alumni_answer_multi_choice = AlumniAnswerMultipleChoiceItem::where('kueswer_multiple_choice_id', $item->id)->get();
                            foreach ($alumni_answer_multi_choice as $item_detail) {
                                $total += $item_detail->item->value;
                            }
                        }
                        foreach($kuesioner->multipleChoice as $item) {
                            $value = 0;
                            $alumni_answer_multi_choice = AlumniAnswerMultipleChoiceItem::where('kueswer_multiple_choice_id', $item->id)->get();
                            foreach ($alumni_answer_multi_choice as $item_detail) {
                                $value += $item_detail->item->value;
                            }

                            if ($total == 0) {
                                $total = 1;
                            }
                            $value = $value / $total * 100;
                            array_push($header, [$i++, $item->notes, NumberHelper::formatQuantity($value) .'%']);
                        }
                    }
                    
                    $sheet->fromArray($header, null, 'A3', false, false);
                });
            }
        })->store('xls', $path);
        return url('download/export/'.$file_name.'.xls');
    }
}
