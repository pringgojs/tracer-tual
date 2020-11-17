<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $view = view('participant.index');
        $view->list_participant = Alumni::orderBy('id', 'desc')->paginate(50);
        return $view;
    }

    /** jawaban alumni */
    public function alumniAnswer($alumni_id)
    {
        $view = view('participant.alumni-answer');
        $view->alumni = Alumni::findOrFail($alumni_id);
        return $view;
    }
}
