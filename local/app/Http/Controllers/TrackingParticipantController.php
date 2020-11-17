<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use App\Models\Alumni;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Helpers\TracerHelper;

class TrackingParticipantController extends Controller
{
    public function index(Request $request)
    {
        $view = view('tracking.index');
        $view->schedule = TracerHelper::getSchedule();
        $view->target_participant = Student::joinClass()
            ->joinProgramStudy()
            ->where('students.status', 'L')
            ->where('students.angkatan', auth()->user()->surveyor->generation)
            ->where('class.jurusan', auth()->user()->surveyor->program_study_id)
            ->count();
        $view->participant_done = Alumni::joinAlumniAnswer()
            ->where('alumni_answer.schedule_id', $view->schedule->id)
            ->where('generation', auth()->user()->surveyor->generation)
            ->where('program_study', auth()->user()->surveyor->program_study_id)
            ->select('alumni.nrp')
            ->groupBy('alumni.nrp')
            ->get()
            ->count();
        $list_participant_done = Alumni::joinAlumniAnswer()
            ->where('alumni_answer.schedule_id', $view->schedule->id)
            ->where('generation', auth()->user()->surveyor->generation)
            ->where('program_study', auth()->user()->surveyor->program_study_id)
            ->select('alumni.nrp')
            ->groupBy('alumni.nrp')
            ->get('alumni.nrp');
        
        $keyed = $list_participant_done->mapWithKeys(function ($item) {
            return [$item['nrp'] => $item['nrp']];
        });
        $view->list_participant_done = $keyed->toArray();

        $view->list_participant_pending = Student::joinClass()
            ->joinProgramStudy()
            ->where('students.status', 'L')
            ->where('students.angkatan', auth()->user()->surveyor->generation)
            ->where('class.jurusan', auth()->user()->surveyor->program_study_id)
            ->select('students.*')
            ->where(function($q) use ($request, $view) {
                $filter = $request->input('filter');
                if (!$filter) {
                    return true;
                }

                if ($filter == 1) {
                    $q->whereIn('students.nrp', $view->list_participant_done);
                } 
                
                if ($filter == 0) {
                    $q->whereNotIn('students.nrp', $view->list_participant_done);
                }
            })
            ->paginate(20);
        return $view;
    }

    public function downloadExcel($type="all")
    {
        $schedule = TracerHelper::getSchedule();
        $data = Alumni::joinAlumniAnswer()
            ->where('alumni_answer.schedule_id', $schedule->id)
            ->where('generation', auth()->user()->surveyor->generation)
            ->where('program_study', auth()->user()->surveyor->program_study_id);
        $done = $data->select('alumni.nrp')
            ->groupBy('alumni.nrp')
            ->get('alumni.nrp');
        $done = $done->mapWithKeys(function ($item) {
            return [$item['nrp'] => $item['nrp']];
        });
        $done = $done->toArray();

        $name = 'ALUMNI SUDAH ENTRY';       
        if ($type == 0 || $type == 'all') {
            $name = 'ALUMNI BELUM ENTRY';       
            if ($type  == 'all') {
                $name = 'SEMUA ALUMNI';
            }
            $data = Student::joinClass()
                ->joinProgramStudy()
                ->where('students.status', 'L')
                ->where('students.angkatan', auth()->user()->surveyor->generation)
                ->where('class.jurusan', auth()->user()->surveyor->program_study_id)
                ->where(function($q) use ($type, $done) {
                    if ($type != 'all') {
                        $q->whereNotIn('students.nrp', $done);
                    }
                })
                ->select('students.*')
                ->get();
        }

        if ($type == 1) {
            $data = $data->select('students.*')->groupBy('students.nrp')->get();
        }
        
        \Excel::create($name .'-'.date('Ymdhis'), function ($excel) use ($data, $type, $done) {
                    
            $excel->sheet('ALUMNI ', function ($sheet) use ($data, $type, $done) {
                $sheet->setWidth(array(
                    'A' => 25,
                    'B' => 25,
                    'C' => 25,
                ));
                
                
                $header = array(array('NO', 'NRP', 'NAMA', 'ALAMAT', 'JURUSAN', 'ANGKATAN', 'TAHUN LULUS', 'STATUS'));

                // onprogress
                if ($type != 1) {
                    foreach ($data as $row => $student) {
                        $status = 'MENUNGGU';
                        if (in_array($student->nrp, $done)) {
                            $status = 'SELESAI';
                        }
                        array_push($header, [$row+1, $student->nrp, $student->nama, $student->alamat, $student->classes ? $student->classes->programStudy->jurusan_lengkap : '', $student->angkatan, $student->tahun_lulus, $status]);
                    }
                }

                // done
                if ($type == 1) {
                    foreach ($data as $row => $student) {
                        array_push($header, [$row+1, $student->nrp, $student->name, $student->address, $student->programStudy->jurusan_lengkap, $student->generation, $student->year_of_graduated, 'SELESAI']);
                    }
                }

                $sheet->fromArray($header, null, 'A1', false, false);
            });
                    
            
        })->export('xls');
        return redirect()->back();
    }
}
