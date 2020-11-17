<?php

namespace App\Http\Controllers;

use App\Models\KuesionerGroup;
use App\Models\Kuesioner;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getGroupKuesioner()
    {
        $list_kuesioner_group = KuesionerGroup::all();
        return response()->json($list_kuesioner_group);
    }

    public function getKuesioner()
    {
        $list_kuesioner = Kuesioner::all();
        return response()->json($list_kuesioner);
    }

    public function getKuesionerGroup($group_id)
    {
        $list_kuesioner = Kuesioner::where('kuesioner_group_id', $group_id)->get();
        return response()->json($list_kuesioner);
    }

    public function getKuesionerGroupName($group_name)
    {
        $group_name = str_replace('-', ' ', $group_name);
        $kuesioner_group = KuesionerGroup::where('name', $group_name)->first();
        $list_kuesioner = Kuesioner::where('kuesioner_group_id', $kuesioner_group->id)->get();
        return response()->json($list_kuesioner);
    }
}
