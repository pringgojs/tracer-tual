<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $view = view('job.index');
        $view->jobs = JobTitle::all();
        return $view;
    }

    public function create()
    {
        $view = view('job.create');
        $view->jobs = JobTitle::all();
        return $view;
    }

    public function store(Request $request)
    {
        $job = new JobTitle();
        $job->name = \Input::get('name');
        $job->notes = \Input::get('notes');
        $job->save();

        toaster_success('create form success');
        return redirect('job');
    }

    public function edit($id)
    {
        $job = JobTitle::find($id);
        if (!$job) {
            throw new AppException("Bad request", 400);
        }

        $view = view('job.edit');
        $view->job = $job;
        return $view;
    }

    public function update(Request $request, $id)
    {
        $job = JobTitle::findOrFail($id);
        $job->name = \Input::get('name');
        $job->notes = \Input::get('notes');
        $job->save();

        toaster_success('update form success');
        return redirect('job');
    }

    public function destroy($id) 
    {
        $job = JobTitle::findOrFail($id);
        $job->delete();

        toaster_success('delete form success');
        return redirect('job');
    }
}
