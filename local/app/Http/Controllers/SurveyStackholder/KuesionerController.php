<?php

namespace App\Http\Controllers\SurveyStackholder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Survey\SurveyKuesioner;
use App\Models\Survey\SurveySettingDashboard;

class KuesionerController extends Controller
{
    public function index()
    {
        $view = view('survey-stackholder.kuesioner.index');
        $view->list_kuesioner = SurveyKuesioner::orderBy('order_number', 'ASC')->paginate(100);
        return $view;
    }

    public function _show($id)
    {
        $view = view('survey-stackholder.kuesioner._show');
        $view->kuesioner = SurveyKuesioner::findOrFail($id);
        return $view;
    }

    public function _chart($id) 
    {
        $view = view('survey-stackholder.kuesioner._settingChart');
        $view->setting = SurveySettingDashboard::where('kuesioner_id', $id)->first();
        $view->kuesioner = SurveyKuesioner::find($id);
        return $view;
    }

    public function _chartStore(Request $request) 
    {
        $setting = SurveySettingDashboard::where('kuesioner_id', $request->input('kuesioner_id'))->first() ? : new SurveySettingDashboard;
        $setting->type_of_chart = $request->input('chart_type');
        $setting->kuesioner_id = $request->input('kuesioner_id');
        $setting->user_id = auth()->user()->id;
        $setting->save();
        
        return 'saved';
    }
}
