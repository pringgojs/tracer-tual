<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeOfBusiness;

class TypeBusinessController extends Controller
{
    public function index()
    {
        $view = view('type-business.index');
        $view->types = TypeOfBusiness::all();
        return $view;
    }

    public function create()
    {
        $view = view('type-business.create');
        $view->types = TypeOfBusiness::all();
        return $view;
    }

    public function store(Request $request)
    {
        $type = new TypeOfBusiness();
        $type->name = \Input::get('name');
        $type->notes = \Input::get('notes');
        $type->save();

        toaster_success('create form success');
        return redirect('type-business');
    }

    public function edit($id)
    {
        $type = TypeOfBusiness::find($id);
        if (!$type) {
            throw new AppException("Bad request", 400);
        }

        $view = view('type-business.edit');
        $view->type = $type;
        return $view;
    }

    public function update(Request $request, $id)
    {
        $type = TypeOfBusiness::findOrFail($id);
        $type->name = \Input::get('name');
        $type->notes = \Input::get('notes');
        $type->save();

        toaster_success('update form success');
        return redirect('type-business');
    }

    public function destroy($id) 
    {
        $type = TypeOfBusiness::findOrFail($id);
        $type->delete();

        toaster_success('delete form success');
        return redirect('type-business');
    }
}
