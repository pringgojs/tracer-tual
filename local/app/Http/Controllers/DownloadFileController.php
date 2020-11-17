<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadFileController extends Controller
{
    public function download($folder, $name)
    {
        $path = storage_path('app/public/'.$folder.'/' . $name);
        if (file_exists($path)) { 
            return \Response::download($path);
        }
    }
}
