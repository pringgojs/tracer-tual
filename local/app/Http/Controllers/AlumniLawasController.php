<?php

namespace App\Http\Controllers;

use App\Models\AlumniLawas;
use Illuminate\Http\Request;

class AlumniLawasController extends Controller
{
    public function index()
    {
        $view = view('alumnus.lawas-index');
        $view->list_alumni = AlumniLawas::all();
        return $view;
    }
    
    public function delete(Request $request, $id)
    {
        $alumni = AlumniLawas::findOrFail($id);
        $alumni->delete();
        toaster_success('delete form success');
        return redirect('alumni-lawas');
    }
}
