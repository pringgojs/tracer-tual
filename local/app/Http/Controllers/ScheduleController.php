<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Program;
use App\Models\Student;
use App\ScheduleDetail;
use App\Models\Schedule;
use App\Models\Generation;
use App\Models\TahunLulus;
use App\Models\AlumniAnswer;
use App\Models\ProgramStudy;
use Illuminate\Http\Request;
use App\Helpers\TracerHelper;

class ScheduleController extends Controller
{
    public function index()
    {
        $view = view('schedule.index');
        $view->list_schedule = Schedule::paginate(100);

        return $view;
    }

    public function create()
    {
        $view = view('schedule.create');
        $view->tahun_lulus = TahunLulus::all();
        $view->study_programs = ProgramStudy::all();
        $view->programs = Program::all();
        return $view;
    }


    public function edit($id)
    {
        $view = view('schedule.edit');
        $view->schedule = Schedule::findOrFail($id);
        $view->tahun_lulus = TahunLulus::all();
        $view->study_programs = ProgramStudy::all();
        $view->programs = Program::all();

        return $view;
    }

    public function store(Request $request)
    {
        TracerHelper::createSchedule($request);
        toaster_success('create form success');
        
        return redirect('schedule/create');
    }

    public function update(Request $request, $id)
    {
        TracerHelper::createSchedule($request, $id);
        toaster_success('update form success');
        return redirect('schedule');
    }

    public function destroy(Request $request, $id)
    {
        \DB::beginTransaction();
        $schedule = Schedule::find($id);
        $schedule->delete();
        
        \DB::commit();

        toaster_success('delete form success');
        return redirect('schedule');
    }

    public function _detail($id)
    {
        $view = view('schedule._detail');
        $view->schedule = Schedule::findOrFail($id);

        return $view;
    }

    public function _report($id)
    {
        $view = view('schedule._report');
        $view->schedule = Schedule::findOrFail($id);

        return $view;
    }

    public function _detailDepartment($id)
    {
        $view = view('schedule._detail-department');
        $view->schedule = Schedule::findOrFail($id);

        return $view;
    }

    public function _detailProgramStudy($id)
    {
        $view = view('schedule._detail-program-study');
        $view->schedule = Schedule::findOrFail($id);

        return $view;
    }

    public function downloadExcelReport($id, $tahun_lulus, $program_study_id, $program)
    {
        $schedule = Schedule::findOrFail($id);
        $program_study = ProgramStudy::find($program_study_id);
        $program = Program::find($program);
        $name = $tahun_lulus . ' - ' .$program_study->jurusan.'-'.$program->program;
        if (strlen($name) > 31) {
            $name = substr($name, 0, 29);
        }
        \Excel::create($name, function ($excel) use ($schedule, $tahun_lulus, $program_study, $name, $program) {
                    
            $excel->sheet($name, function ($sheet) use ($schedule, $tahun_lulus, $program_study, $program) {
                $sheet->setWidth(array(
                    'A' => 25,
                    'B' => 25,
                    'C' => 25,
                ));

                $students = Student::joinClass()
                    ->joinProgramStudy()
                    ->where('students.status', 'L')
                    ->where('students.tahun_lulus', $tahun_lulus)
                    ->where('class.jurusan', $program_study->nomor)
                    ->where('class.program', $program->nomor)
                    ->select('students.*')
                    ->get();
                $data = array(array('NO', 'NRP', 'NAMA', 'JENIS KELAMIN', 'EMAIL', 'ALAMAT', 'JURUSAN', 'PROGRAM', 'ANGKATAN', 'TAHUN LULUS', 
                    'STATUS PEKERJAAN', 'PERUSAHAAN', 
                ));
                $array_inserted = [];
                foreach ($students as $row => $student) {
                    $alumni_answer = AlumniAnswer::where('nrp', $student->nrp)->where('schedule_id', $schedule->id)->first();
                    if (!$alumni_answer) array_push($array_inserted, $row+1);

                    $alumni = Alumni::where('nrp', $student->nrp)->first();
                    // Request Dari pak moko, menampilkan perusahaan dan telepon
                    // status pekerjaan
                    $status_pekerjaan = AlumniAnswer::where('kuesioner_id', 1)->where('nrp', $student->nrp)->first();
                    $status = $status_pekerjaan ? $status_pekerjaan->answerMultipleChoice->kuesionerAnswer->notes : '';
                    $tempat_bekerja = '';
                    $hp = $alumni_answer ? $alumni_answer->alumni->phone : '';
                    if ($status_pekerjaan) {
                        if ($status_pekerjaan->answerMultipleChoice->kuesionerAnswer->id == 1) {
                            // jika pekerjaan = Bekerja
                            $perusahaan_tempat_bekerja = AlumniAnswer::where('kuesioner_id', 61)->where('nrp', $student->nrp)->first();
                            $tempat_bekerja = $perusahaan_tempat_bekerja ? $perusahaan_tempat_bekerja->answerDescription->description : '';
                        }
                        if ($status_pekerjaan->answerMultipleChoice->kuesionerAnswer->id == 2) {
                            // jika pekerjaan = Bekerja dan berwirausaha
                            $perusahaan_tempat_bekerja = AlumniAnswer::where('kuesioner_id', 62)->where('nrp', $student->nrp)->first();
                            $tempat_bekerja = $perusahaan_tempat_bekerja ? $perusahaan_tempat_bekerja->answerDescription->description : '';
                        }
                    }

                    $tahun_lulus = $student->tahun_lulus;
                    // if ($alumni) {
                    //     if (($alumni->generation == 2012 && $student->classes->program == 4 || $alumni->generation == 2013 && $student->classes->program == 3)) {
                    //         $tahun_lulus = 2016;
                    //     }
                    // } else {
                    //     $tgl_masuk = explode('-', $student->tglmasuk)[0];
                    //     if (($tgl_masuk == 2012 && $student->classes->program == 4 || $tgl_masuk == 2013 && $student->classes->program == 3)) {
                    //         $tahun_lulus = 2016;
                    //     }
                    // }

                    array_push($data, [$row+1, $student->nrp, $student->nama, $alumni ? $alumni->gender ? 'Laki-laki' : 'Perempuan' : '-', 
                        $alumni ? $alumni->email : '-', 
                        $student->alamat, $student->classes ? $student->classes->programStudy->jurusan_lengkap : '', 
                        $student->classes ? $student->classes->programx->program : '', $student->angkatan, $tahun_lulus,
                        $status, $tempat_bekerja]);
                }

                for ($i=0; $i<count($array_inserted); $i++) {
                    $row = $array_inserted[$i]+1;
                    $sheet->row($row, function($row) {
                        $row->setBackground('#d2c20b');
                    });    
                }
                
                $sheet->fromArray($data, null, 'A1', false, false);
            });
                    
            
        })->export('xls');
        return redirect()->back();
    }
}
