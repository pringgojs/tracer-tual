<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use App\Models\KuesionerGroup;
use App\Models\KuesionerLogic;
use App\Models\KuesionerModelAnswer;
use App\Models\SettingDashboardChart;
use App\Models\KuesionerAnswerMultipleChoice;
use App\Models\KuesionerAnswerMultipleChoiceItem;

class KuesionerController extends Controller
{
    public function index()
    {
        $view = view('kuesioner.index');
        $view->list_kuesioner = Kuesioner::orderBy('id')->paginate(100);
        $view->list_group = KuesionerGroup::all();
        return $view;
    }

    public function create()
    {
        $view = view('kuesioner.create-wizard');
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner_model_answer = KuesionerModelAnswer::all();
        return $view;
    }

    public function _show($id) 
    {
        $view = view('kuesioner._show');
        $view->kuesioner = Kuesioner::find($id);
        
        return $view;
    } 

    public function showByGroup($id) 
    {
        $view = view('kuesioner._data-kuesioner');
        $view->list_group = KuesionerGroup::all();
        $view->list_kuesioner = Kuesioner::all();
        if ($id == 'all') {
            return $view;
        }

        $group = KuesionerGroup::find($id);
        if (!$group) {
            return $view;
        }

        $view->list_kuesioner = Kuesioner::where('kuesioner_group_id', $id)->get();
        return $view;
    }

    public function _storeSort(Request $request) 
    {
        $data = $request->input('data');
        $data = explode("&", $data);
        for ($i=0; $i < count($data); $i++) {
            $child = explode("=", $data[$i]);
            for ($x=0; $x < count($child); $x++) {
                $kuesioner = Kuesioner::find($child[1]);
                $kuesioner->order_number = $i+1;
                $kuesioner->save();
            }
        }
        
        return 'saved';
    }

    public function _showSetting($id) 
    {
        $view = view('kuesioner._settingChart');
        $view->setting = SettingDashboardChart::where('kuesioner_id', $id)->first();
        $view->kuesioner = Kuesioner::find($id);
        return $view;
    }


    public function _storeSetting(Request $request) 
    {
        $setting = SettingDashboardChart::where('kuesioner_id', $request->input('kuesioner_id'))->first() ? : new SettingDashboardChart;
        $setting->type_of_chart = $request->input('chart_type');
        $setting->kuesioner_id = $request->input('kuesioner_id');
        $setting->save();
        
        return 'saved';
    }

    public function _getBy($group, $type) 
    {
        $data = Kuesioner::where('kuesioner_group_id', $group)
            ->where(function($que) use ($type) {
                if ($type != "") {
                    $que->where('kuesioner_model_answer_id', $type);
                }
            })
            ->select('id', 'kuesioner')
            ->get();
        return json_encode($data);
    }

    public function _getAnswer($kuesioner_id) 
    {
        $data = KuesionerAnswerMultipleChoice::where('kuesioner_id', $kuesioner_id)
            ->select('id', 'notes')
            ->get();
        
        return json_encode($data);
    }

    /** get kuesioner tipe C. untuk menampilkan list pertanyaan yg digunakan untuk logic */
    public function _getKuesionerTipeC() 
    {
        $data = Kuesioner::where('kuesioner_model_answer_id', 3)
            ->select('id', 'kuesioner')
            ->get();
        return json_encode($data);
    }

    /** hapus item value */
    public function _removeItemValue($id)
    {
        $item = KuesionerAnswerMultipleChoiceItem::findOrFail($id);
        $item->delete();

        return 1;
    }

    /** hapus item  */
    public function _removeItem($id)
    {
        $item = KuesionerAnswerMultipleChoice::findOrFail($id);
        $item->delete();

        return 1;
    }

    /** hapus logic */
    public function _removeLogic($id)
    {
        $item = KuesionerLogic::findOrFail($id);
        $item->delete();

        return 1;
    }
}
