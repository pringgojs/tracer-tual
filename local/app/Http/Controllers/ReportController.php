<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniAnswer;
use App\Models\AlumniAnswerDescription;

class ReportController extends Controller
{
    public function index()
    {
        $array = [61, 62];
        $alumni_answer = AlumniAnswer::whereIn('kuesioner_id', $array)->select('id')->get()->toArray();
        $alumni_answer_description = AlumniAnswerDescription::whereIn('alumni_answer_id', $alumni_answer)
            ->select('description')
            ->groupBy('description')
            ->orderBy('description')
            ->paginate(25);
        $view = view('report.index');
        $view->alumni_answer_description = $alumni_answer_description;
        return $view;
    }

    public function detail()
    {
        $perusahaan = \Input::get('name');
        $alumni_answer = AlumniAnswerDescription::joinAlumniAnswer()->joinAlumni()->where('alumni_answer_description.description', $perusahaan)
            ->select('alumni.*')
            ->get();
        $view = view('report.detail');
        $view->alumni_answer = $alumni_answer;
        return $view;
    }
}
