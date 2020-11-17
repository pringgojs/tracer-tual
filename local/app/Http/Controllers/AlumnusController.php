<?php

namespace App\Http\Controllers;

use App\Models\Alumnus;
use Illuminate\Http\Request;

class AlumnusController extends Controller
{
    public function index()
    {
        $view = view('alumnus.index');
        $view->list_alumnus = Alumnus::all();
        return $view;
    }

    public function create()
    {
        $view = view('alumnus.create');
        $view->alumnus = Alumnus::all();
        return $view;
    }

    public function store(Request $request)
    {
        $alumnus = new Alumnus();
        $alumnus->name = \Input::get('name');
        $alumnus->nrp = \Input::get('nrp');
        $alumnus->email = \Input::get('email');
        $alumnus->graduated_date = \Input::get('graduated_date');
        $alumnus->save();

        toaster_success('create form success');
        return redirect('alumnus');
    }

    public function edit($id)
    {
        $alumnus = Alumnus::find($id);
        if (!$alumnus) {
            throw new AppException("Bad request", 400);
        }

        $view = view('alumnus.edit');
        $view->alumnus = $alumnus;
        return $view;
    }

    public function update(Request $request, $id)
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->name = \Input::get('name');
        $alumnus->nrp = \Input::get('nrp');
        $alumnus->email = \Input::get('email');
        $alumnus->graduated_date = \Input::get('graduated_date');
        $alumnus->save();

        toaster_success('update form success');
        return redirect('alumnus');
    }

    public function destroy($id) 
    {
        $alumnus = Alumnus::findOrFail($id);
        $alumnus->delete();

        toaster_success('delete form success');
        return redirect('alumnus');
    }
}
