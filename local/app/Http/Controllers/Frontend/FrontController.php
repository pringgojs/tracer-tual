<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Alumni;
use App\Models\Student;
use App\Helpers\FrontHelper;
use Illuminate\Http\Request;
use App\Models\AlumniPeriodeAnswer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class FrontController extends Controller
{
    public function index()
    {
        return redirect('tracer-study');
    }

    /** Login form tracer studi */
    public function tracerStudyLogin()
    {
        if (Cookie::get('nrp')) {
            return redirect('tracer-study');
        }
        return view('frontend.login-tracer-study');
    }

    /** Login proses */
    public function tracerStudyLoginProses(Request $request)
    {
        $nrp = strtoupper($request->input('nrp'));

        /** cek mhs ada apa tidak */
        $student = Student::where('nrp', $nrp)->where('status', 'L')->first();
        if (!$student) {
            return redirect()->back()->with(['error' => 'NIM tidak ditemukan']);
        }

        /** cek periode ada apa tidak */
        $periode = FrontHelper::getPeriode($nrp);
        if (!$periode) {
            return redirect()->back()->with(['error' => 'Periode belum diseting. Silahkan tunggu hingga sudah diseting']);
        }

        /** cek jadwal ada apa tidak */
        $schedule = FrontHelper::getSchedule($student);
        if (!$schedule) {
            return redirect()->back()->with(['error' => 'Jadwal untuk angkatan Anda belum dibuka. Silahkan tunggu hingga sudah dibuka']);
        }

        Cookie::queue('nrp', $nrp, 500);
        return redirect('tracer-study');

    }

    /** logout */
    public function tracerStudyLogout()
    {
        Cookie::queue(Cookie::forget('nrp'));

        return redirect('tracer-study/login');
    }
}
