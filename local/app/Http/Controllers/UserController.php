<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Student;
use App\Models\Surveyor;
use App\Models\ProgramStudy;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $view = view('user.index');
        $view->users = User::all();
        return $view;
    }

    public function create()
    {
        $view = view('user.create');
        $view->program_studies = ProgramStudy::all();
        $view->generations = Student::select('angkatan')->groupBy('angkatan')->get();
        $view->roles = Role::all();
        return $view;
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        $user = new User;
        $user->name = \Input::get('name');
        $user->password = bcrypt(\Input::get('password'));
        $user->email = \Input::get('email');
        $user->save();

        $role = Role::find(\Input::get('role'));
        if ($role->slug == 'surveyor') {
            $userveyor = new Surveyor;
            $userveyor->user_id = $user->id;
            $userveyor->phone = \Input::get('phone');
            $userveyor->address = \Input::get('address');
            $userveyor->program_study_id = \Input::get('program_study');
            $userveyor->generation = \Input::get('generation');
            $userveyor->save();
        }

        $user->attachRole($role);
        \DB::commit();
        toaster_success('create form success');
        return redirect('user');
    }

    public function edit($id)
    {
        $view = view('user.edit');
        $view->user = User::findOrFail($id);
        $view->program_studies = ProgramStudy::all();
        $view->generations = Student::select('angkatan')->groupBy('angkatan')->get();
        $view->roles = Role::all();

        return $view;
    }

    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        $user = User::findOrFail($id);
        $user->name = \Input::get('name');
        $user->email = \Input::get('email');
        if (\Input::get('password')) {
            $user->password = bcrypt(\Input::get('password'));
        }
        $user->save();
        
        $user->detachAllRoles();
        $role = Role::find(\Input::get('role'));
        $surveyor = Surveyor::where('user_id', $user->id)->first();
        if ($surveyor) $surveyor->delete();

        if ($role->slug == 'surveyor') {
            $userveyor = $surveyor ? : new Surveyor;
            $userveyor->user_id = $user->id;
            $userveyor->phone = \Input::get('phone');
            $userveyor->address = \Input::get('address');
            $userveyor->program_study_id = \Input::get('program_study');
            $userveyor->generation = \Input::get('generation');
            $userveyor->save();
        }

        $user->attachRole($role);
        \DB::commit();
        toaster_success('update form success');
        return redirect('user');
    }

    public function destroy($id) 
    {
        if ($id == 1) {
            toaster_error('Error, this user is protected');
            return redirect('user');
        }
        
        $user = User::findOrFail($id);
        $user->delete();

        toaster_success('delete form success');
        return redirect('user');
    }
}
