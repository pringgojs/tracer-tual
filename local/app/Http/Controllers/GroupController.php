<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KuesionerGroup;
use App\Traits\ValidationTrait;
use App\Exceptions\AppException;

class GroupController extends Controller
{
    // use ValidationTrait;
    public function index()
    {
        $view = view('group.index');
        $view->groups = KuesionerGroup::all();
        return $view;
    }

    public function create()
    {
        $view = view('group.create');
        $view->groups = KuesionerGroup::all();
        return $view;
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'order_number' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            toaster_error('create form failed');
            return redirect('group/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $group = new KuesionerGroup();
        $group->name = \Input::get('name');
        $group->link = \Input::get('link');
        $group->description = \Input::get('description');
        $group->order_number = \Input::get('order_number');
        $group->icon = \Input::get('icon');
        $group->save();

        toaster_success('create form success');
        return redirect('group');
    }

    public function edit($id)
    {
        $group = KuesionerGroup::find($id);
        if (!$group) {
            throw new AppException("Bad request", 400);
        }

        $view = view('group.edit');
        $view->group = $group;
        return $view;
    }

    public function update(Request $request, $id)
    {
        $group = KuesionerGroup::findOrFail($id);
        $group->name = \Input::get('name');
        $group->link = \Input::get('link');
        $group->description = \Input::get('description');
        $group->order_number = \Input::get('order_number');
        $group->icon = \Input::get('icon');
        $group->save();

        toaster_success('update form success');
        return redirect('group');
    }

    public function _storeSort(Request $request) 
    {
        $data = $request->input('data');
        $data = explode("&", $data);
        for ($i=0; $i < count($data); $i++) {
            $child = explode("=", $data[$i]);
            for ($x=0; $x < count($child); $x++) {
                $group = KuesionerGroup::find($child[1]);
                $group->order_number = $i+1;
                $group->save();
            }
        }
        
        return 'saved';
    }

    public function destroy($id) 
    {
        $group = KuesionerGroup::findOrFail($id);
        $group->delete();
        
        toaster_success('delete form success');
        return redirect('group');
    }
}
