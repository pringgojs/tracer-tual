<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class TempController extends Controller
{
    public function store(Request $request)
    {
        $temp = new Temp;
        $temp->name = $request->input('name');
        $temp->user_id = $request->input('user_id');
        $temp->keys = serialize($request->input('keys'));
        $temp->save();

        return response()->json([
            'data' => $temp->toArray(),
        ]);
    }

    public function testsStoreTemp(Request $request)
    {
        $url = 'http://localhost/ts-pens-oracle/api/temp';
        $response = Curl::to($url)
        ->withData( $request->toArray() )
        ->post();
    
        return $response;
    }
}
