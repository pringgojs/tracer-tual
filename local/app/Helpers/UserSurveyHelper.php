<?php

namespace App\Helpers;

use App\Models\Survey\Survey;
use App\Models\Survey\SurveyPeriode;
use App\Models\Survey\SurveyKuesioner;
use App\Models\Survey\SurveyKuesionerDetail;


class UserSurveyHelper
{
    public static function createPeriode($request, $id="")
    {
        \DB::beginTransaction();
        
        $periode = $id ? SurveyPeriode::findOrFail($id) : new SurveyPeriode;
        $periode->name = $request->input('name');
        $periode->status = $request->input('status');
        $periode->save();

        \DB::commit();
        return $periode;
    }

    public static function createCompanyAccount($request, $id="")
    {
        \DB::beginTransaction();
        
        $company = $id ? Survey::findOrFail($id) : new Survey;
        $company->username = $request->input('username');
        $company->password = $request->input('password');
        $company->created_by = auth()->user()->id;
        $company->save();

        \DB::commit();
        return $company;
    }

    public static function createKuesioner($request, $id="")
    {
        \DB::beginTransaction();
        
        $kuesioner = $id ? SurveyKuesioner::findOrFail($id) : new SurveyKuesioner;
        $kuesioner->kuesioner = $request->input('kuesioner');
        $kuesioner->periode_id = $request->input('periode_id');
        $kuesioner->order_number = $request->input('order_number');
        $kuesioner->save();

        if ($id) {
            SurveyKuesionerDetail::where('survey_kuesioner_id', $id)->delete();
        }
        
        # Insert ne child
        $list_answer  = $request->input('answer');
        for ($i = 0; $i < count($list_answer); $i++) {
            $detail = new SurveyKuesionerDetail;
            $detail->survey_kuesioner_id = $kuesioner->id;
            $detail->notes = $list_answer[$i];
            $detail->save();
        }
        \DB::commit();
        return $kuesioner;
    }
}