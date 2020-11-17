<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use App\Exceptions\AppException;
use App\Models\KuesionerPeriode;

class PeriodController extends Controller
{
    public function index()
    {
        $view = view('period.index');
        $view->list_period = Periode::paginate(100);

        return $view;
    }

    public function create()
    {
        $view = view('period.create');

        return $view;
    }


    public function edit($id)
    {
        $view = view('period.edit');
        $view->period = Periode::find($id);
        if (!$view->period) {
            throw new AppException('Bad Request', 400);
        }

        return $view;
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        
        $range = explode(";", $request->input('range'));
        $period = new Periode;
        $period->name = $request->input('name');
        $period->lower_limit = $range[0];
        $period->upper_limit = $range[1];
        $period->save();

        \DB::commit();
        toaster_success('create form success');
        
        return redirect('period/create');
    }

    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        
        $range = explode(";", $request->input('range'));
        $period = Periode::find($id);
        $period->name = $request->input('name');
        $period->lower_limit = $range[0];
        $period->upper_limit = $range[1];
        $period->save();

        \DB::commit();

        toaster_success('update form success');
        return redirect('period');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $period = Periode::find($id);
        $period->delete();
        
        \DB::commit();

        toaster_success('delete form success');
        return redirect('period');
    }

    /** form set kuesioner */
    public function _setKuesioner(Request $request, $id)
    {
        $view = view('period._set-kuesioner');
        $view->period = Periode::find($id);
        $view->list_kuesioner = Kuesioner::published()->orderBy('id')->get();
        if (!$view->period) {
            throw new AppException('Bad Request', 400);
        }

        return $view;
    }

   /** simpan pengaturan kuesioner */ 
    public function _store(Request $request)
    {
        \DB::beginTransaction();
        KuesionerPeriode::where('periode_id', $request->input('periode_id'))->delete();

        $kuesioner_id = $request->input('kuesioner_id');
        for ($i=0; $i < count($kuesioner_id); $i++) { 
            $periode = new KuesionerPeriode;
            $periode->kuesioner_id = $kuesioner_id[$i];
            $periode->periode_id = $request->input('periode_id');
            $periode->number_order = $i + 1;
            $periode->save();
        }

        \DB::commit();

        return 'success';
    }

    /** form order kuesioner */
    public function kuesionerOrder($periode_id)
    {
        $view = view('period.form-order-kuesioner');
        $view->periode = Periode::findOrFail($periode_id);
        $view->list_kuesioner_periode = KuesionerPeriode::where('periode_id', $periode_id)->orderBy('number_order')->get();
        return $view;
    }

    /** simpan kuesioner order */
    public function simpanKuesionerOrder(Request $request)
    {
        $data = $request->input('data');
        $data = explode("&", $data);
        for ($i=0; $i < count($data); $i++) {
            $child = explode("=", $data[$i]);
            for ($x=0; $x < count($child); $x++) {
                $kuesioner = KuesionerPeriode::where('kuesioner_id', $child[1])->where('periode_id', $request->input('periode_id'))->first();
                $kuesioner->number_order = $i+1;
                $kuesioner->save();
            }
        }
        
        return 'saved';
    }
}
