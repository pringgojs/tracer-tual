<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Alumni;
use App\Models\Student;
use App\Models\Kuesioner;
use App\Helpers\FrontHelper;
use App\Models\AlumniAnswer;
use Illuminate\Http\Request;
use App\Helpers\NumberHelper;
use App\Models\KuesionerLogic;
use App\Models\KuesionerPeriode;
use App\Models\AlumniAnswerOther;
use Illuminate\Support\Facades\DB;
use App\Models\AlumniPeriodeAnswer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\AlumniAnswerDescription;
use App\Models\AlumniAnswerMultipleChoice;
use App\Models\AlumniAnswerMultipleChoiceItem;

class TracerStudyController extends Controller
{
    /** Form datadiri */
    public function index()
    {
        $alumni = null;
        $nrp = Cookie::get('nrp');

        $student = Student::where('nrp', $nrp)->where('status', 'L')->first();
        $periode = FrontHelper::getPeriode($nrp);
        $schedule = FrontHelper::getSchedule($student);
        $alumni_periode_answer = AlumniPeriodeAnswer::where('identity_id', $student->nrp)->where('periode_id', $periode->id)->first();
        if ($alumni_periode_answer) {
            // data found
            $alumni = Alumni::where('alumni_periode_answer_id', $alumni_periode_answer->id)->first();
        }

        $view = view('frontend.tracer-study.index');
        $view->alumni = $alumni;
        return $view;

    }

    /** 
     * Simpan identitas diri
     * 1. HP
     * 2. Email
     */
    public function simpanIdentitasDiri(Request $request)
    {
        /**
         * Step
         * 1. Create Alumni Periode Answer
         * 2. Create Alumni
         */

        $nrp = Cookie::get('nrp');

        $student = Student::where('nrp', $nrp)->where('status', 'L')->first();
        $periode = FrontHelper::getPeriode($nrp);
        $schedule = FrontHelper::getSchedule($student);
        
        $alumni_periode_answer = AlumniPeriodeAnswer::where('identity_id', $student->nrp)->where('periode_id', $periode->id)->first();
        $alumni = new Alumni;
        if ($alumni_periode_answer) {
            /** cek apakah data alumni sudah ada */
            $alumni = Alumni::where('alumni_periode_answer_id', $alumni_periode_answer->id)->first();
        }

        DB::beginTransaction();

        /** insert data alumni_periode_answer */
        $alumni_periode_answer = $alumni_periode_answer ? : new AlumniPeriodeAnswer;
        $alumni_periode_answer->identity_id = $nrp;
        $alumni_periode_answer->periode_id = $periode->id;
        $alumni_periode_answer->save();

        /** insert alumni */
        $alumni->name = $student->nama;
        $alumni->gender = $student->jenis_kelamin == 'L' ? 1 : 0;
        $alumni->generation = $student->angkatan;
        $alumni->program_study = $student->classes->jurusan;
        $alumni->jenjang = $student->classes->program;
        $alumni->ipk = $student->ipk();
        $alumni->year_of_entry = $student->angkatan;
        $alumni->year_of_graduated = $student->tahun_lulus;
        $alumni->nrp = $student->nrp;
        $alumni->phone = $request->input('hp');
        $alumni->email = $request->input('email');
        $alumni->alumni_periode_answer_id = $alumni_periode_answer->id;
        $alumni->kode_prodi = student()->classes->programx->kode_epsbed;
        $alumni->kode_perguruan_tinggi = 005026;
        $alumni->save();
        DB::commit();

        return redirect('tracer-study/kuesioner');
    }

    /** Form kuesioner */
    public function formKuesioner()
    {
        $kuesioner = null;
        $view = view('frontend.tracer-study.form-kuesioner');

        /**
         * Pengisian form kuesioner
         * 1. ambil data periode terakhir yang sudah dijawab alumni : alumni periode answer
         * 2. tampilkan kuesioner dari kuesioner periode answer
         * 
         */
        
        $nrp = Cookie::get('nrp');
        $student = Student::where('nrp', $nrp)->where('status', 'L')->first();
        $periode = FrontHelper::getPeriode($nrp);
        $schedule = FrontHelper::getSchedule($student);
        $alumni_periode_answer = AlumniPeriodeAnswer::where('identity_id', $student->nrp)->where('periode_id', $periode->id)->first();
        $alumni = Alumni::where('alumni_periode_answer_id', $alumni_periode_answer->id)->first();
        
        /** View binding */
        $view->student = $student;
        $view->periode = $periode;
        $view->schedule = $schedule;
        $view->alumni = $alumni;
        $view->alumni_periode_answer = $alumni_periode_answer;
        $view->kuesioner = self::getKuesioner($periode, $schedule, $student);

        return $view;
    }

    /** get kuesioner */
    public function getKuesioner($periode, $schedule, $student)
    {
        /** cek pertanyaan terakhir yang dijawab oleh peserta */
        $pertanyaan_terakhir = AlumniAnswer::where('periode_id', $periode->id)
            ->where('schedule_id', $schedule->id)
            ->where('nrp', $student->nrp)
            ->orderBy('id', 'desc')
            ->first();
        
        /** jika $pertanyaan_terakhir null, maka alumni belum pernah mengisi kuesioner */
        if (!$pertanyaan_terakhir) {
            /** ambil pertanyaan dari dari kuesioner periode */
            $kuesioner_periode = KuesionerPeriode::where('periode_id', $periode->id)->orderBy('number_order')->first();
            return $kuesioner_periode->kuesioner;
        }
        
        /** cek apakah pertanyaan terakhir apakah tipe C, kalo tipe C maka cek apakah mempunyai logic */
        if ($pertanyaan_terakhir->kuesioner->tipeC()) {
            /** cek apakah jawaban dari pertanyaan terakhir adalah bukan jawaban lainnya */
            if ($pertanyaan_terakhir->answerMultipleChoice) {

                $kuesioner_reference = KuesionerLogic::where('kuesioner_id_ref', $pertanyaan_terakhir->kuesioner_id)
                    ->where('kueswer_multiple_choice_itm_id', $pertanyaan_terakhir->answerMultipleChoice->kueswer_multiple_choice_id)
                    ->first();

                if ($kuesioner_reference) {
                    return self::getPertanyaanTurunan($kuesioner_reference, $periode, $schedule, $student, $pertanyaan_terakhir);
                }
            }
            
        }



        /** cek pertanyaan turunan dalam satu group dengan pertanyaan terakhir */
        $kuesioner_logic = KuesionerLogic::where('kuesioner_id', $pertanyaan_terakhir->kuesioner->id)->first();
        if ($kuesioner_logic) {
            $kuesioner_ref = Kuesioner::find($kuesioner_logic->kuesioner_id_ref);
            return self::getPertanyaanTurunan($kuesioner_logic, $periode, $schedule, $student, $pertanyaan_terakhir);
        }


        /** cari pertanyaan selanjutnya di table kuesioner_periode */
        $nomer_urut_pertanyaan_terakhir = KuesionerPeriode::where('periode_id', $periode->id)
            ->where('kuesioner_id', $pertanyaan_terakhir->kuesioner_id)
            ->orderBy('number_order')
            ->first();
        /** cari pertanyaan selanjutnya yg tidak mempunyai logic */
        $pertanyaan_selanjutnya = KuesionerPeriode::joinKuesioner()
            ->where('kuesioner.is_use_logic', 0)
            ->where('periode_id', $periode->id)
            ->where('number_order', '>', $nomer_urut_pertanyaan_terakhir->number_order)
            ->orderBy('number_order')
            ->select('kuesioner_periode.*')
            ->first();
        
        if ($pertanyaan_selanjutnya) {
            return  $pertanyaan_selanjutnya->kuesioner;
        }



        return null;
    }

    /** get pertanyaan turunan */
    public function getPertanyaanTurunan($kuesioner_reference, $periode, $schedule, $student, $pertanyaan_terakhir)
    {
        /** cek kuesioner yang mempunyai logic dengan kuesioner_ref */
        $id_semua_pertanyaan_turunan = KuesionerLogic::where('kuesioner_id_ref', $kuesioner_reference->kuesioner_id_ref)
            ->where('kueswer_multiple_choice_itm_id', $kuesioner_reference->kueswer_multiple_choice_itm_id)
            ->select('kuesioner_id')
            ->get()
            ->pluck('kuesioner_id')
            ->toArray();
        info($id_semua_pertanyaan_turunan);
        /** pertanyaan turunan yang sudah dijawab */
        $id_pertanyaan_turunan_yg_sudah_dijawab = AlumniAnswer::joinKuesioner()
            ->where('kuesioner.is_use_logic', 1)
            ->where('periode_id', $periode->id)
            ->where('schedule_id', $schedule->id)
            ->where('nrp', $student->nrp)
            ->select('kuesioner_id')
            ->get()
            ->pluck('kuesioner_id')
            ->toArray();
        info($id_pertanyaan_turunan_yg_sudah_dijawab);
            
        /** bandingkan data pertanyaan turunan yang sudah dijawab dan yang belum dijawab **/
        $id_pertanyaan_yg_tersedia = array_diff($id_semua_pertanyaan_turunan, $id_pertanyaan_turunan_yg_sudah_dijawab);
        if (count($id_pertanyaan_yg_tersedia)) {
            /** cari kuesioner di table KUESIONER PERIODE ANSWER yang mana ID KUESIONER ada di $id_pertanyaan_yg_tersedia */
            $kuesioner_selanjutnya = KuesionerPeriode::where('periode_id', $periode->id)
                ->whereIn('kuesioner_id', $id_pertanyaan_yg_tersedia)
                ->orderBy('number_order')
                ->first();
            return $kuesioner_selanjutnya->kuesioner;

        }

        /** cari pertanyaan selanjutnya di table kuesioner_periode */
        $nomer_urut_pertanyaan_terakhir = KuesionerPeriode::where('periode_id', $periode->id)
            ->where('kuesioner_id', $kuesioner_reference->kuesioner_id_ref)
            ->orderBy('number_order')
            ->first();
        // dd($kuesioner_reference); // kuesioner id 9 : Berapa bulan durasi anda mencari pekerjaan pertama sebelum/sesudah lulus ujian ?
        // $kuesioner_reference->kuesioner_id_ref) 8

        $pertanyaan_selanjutnya = KuesionerPeriode::joinKuesioner()
            // ->where('kuesioner.is_use_logic', 0)
            ->where('periode_id', $periode->id)
            ->where('number_order', '>', $nomer_urut_pertanyaan_terakhir->number_order)
            ->select('kuesioner_periode.*')
            ->orderBy('number_order')
            ->first();


        /** jika pertanyaan selanjutnya == pertanyaan terakhir, maka tampilkan pertanyaan dengan urutan nomer urut setelah pertanyaan terakhir*/
        $pertanyaan_sama = false;
        if ($pertanyaan_selanjutnya->kuesioner->id ==  $pertanyaan_terakhir->kuesioner_id) {
            $pertanyaan_selanjutnya = KuesionerPeriode::where('periode_id', $periode->id)
                ->where('number_order', '>', $pertanyaan_selanjutnya->number_order)
                ->orderBy('number_order')
                ->first();
            $pertanyaan_sama = true;

        }

        /** cek pertanyaan pertanyaan_selanjutnya apakah sudah dijawab, ini mbulet di logika bertingkat */
        $cek_pertanyaan_selanjutnya = AlumniAnswer::where('periode_id', $periode->id)
            ->where('schedule_id', $schedule->id)
            ->where('alumni_id', $pertanyaan_terakhir->alumni_id)
            ->where('kuesioner_id', $pertanyaan_selanjutnya->kuesioner_id)
            ->first();

        /** jika pertanyaan sudah dijawab, maka cari pertanyaan setelahnya */
        if ($cek_pertanyaan_selanjutnya) {

            $pertanyaan_terakhir = KuesionerPeriode::where('periode_id', $periode->id)
                ->where('kuesioner_id', $pertanyaan_terakhir->kuesioner_id)
                ->orderBy('number_order')
                ->first();
            $pertanyaan_selanjutnya = KuesionerPeriode::joinKuesioner()
                ->where('kuesioner.is_use_logic', 0)
                ->where('periode_id', $periode->id)
                ->where('number_order', '>', $pertanyaan_terakhir->number_order)
                ->orderBy('number_order')
                ->select('kuesioner_periode.*')
                ->first();
            // dd($pertanyaan_terakhir->kuesioner);
            return $pertanyaan_selanjutnya->kuesioner;
            
        }

        /** jika pertanyaan sama, maka cari pertanyaan yang tidak punya logic setelah pertanyaan terakhir */
        if (!$pertanyaan_sama) {
            $pertanyaan_selanjutnya = KuesionerPeriode::joinKuesioner()
                ->where('kuesioner.is_use_logic', 0)
                ->where('periode_id', $periode->id)
                ->where('number_order', '>', $nomer_urut_pertanyaan_terakhir->number_order)
                ->select('kuesioner_periode.*')
                ->orderBy('number_order')
                ->first();
        }


        return $pertanyaan_selanjutnya->kuesioner;
        
    }

    /** simpan jawaban */
    public function simpanKuesioner(Request $request)
    {
        /** 
         * 1. Simpan alumni answer
         * 2. simpan jawaban di table alumni_answer_multiple_choice
         */
        $nrp = Cookie::get('nrp');
        $kuesioner = Kuesioner::findOrFail($request->kuesioner_id);

        /** simpan alumni answer */
        $alumni_answer = AlumniAnswer::where('kuesioner_id', $request->kuesioner_id)
            ->where('nrp', $nrp)
            ->where('alumni_id', $request->alumni_id)
            ->where('periode_id', $request->periode_id)
            ->where('schedule_id', $request->schedule_id)
            ->first() 
            ? : new AlumniAnswer;

        DB::beginTransaction();
        $alumni_answer->nrp = $nrp;
        $alumni_answer->alumni_id = $request->alumni_id;
        $alumni_answer->periode_id = $request->periode_id;
        $alumni_answer->schedule_id = $request->schedule_id;
        $alumni_answer->kuesioner_id = $request->kuesioner_id;
        $alumni_answer->created_at = Carbon::now();
        $alumni_answer->save();
        DB::commit();

        /** simpan jawaban kuesioner */
        if ($kuesioner->tipeA()) {
            self::simpanJawabanKuesionerTipeA($alumni_answer, $request);

            return redirect('tracer-study/kuesioner');
        }

        if ($kuesioner->tipeC()) {
            self::simpanJawabanKuesionerTipeC($alumni_answer, $request);

            return redirect('tracer-study/kuesioner');
        }

        if ($kuesioner->tipeD()) {
            self::simpanJawabanKuesionerTipeD($alumni_answer, $request);

            return redirect('tracer-study/kuesioner');
        }

        if ($kuesioner->tipeE()) {
            self::simpanJawabanKuesionerTipeE($alumni_answer, $request);

            return redirect('tracer-study/kuesioner');
        }

    }
    
    /** simpan jawaban tipe A */
    public function simpanJawabanKuesionerTipeA($alumni_answer, $request)
    {
        DB::beginTransaction();
        

        $jawaban_alumni = AlumniAnswerDescription::where('alumni_answer_id', $alumni_answer->id)
            ->first() ? : new AlumniAnswerDescription;
        
        $input = $request['input'];
        if ($alumni_answer->kuesioner->type_of_field == 'number') {
            $input = NumberHelper::formatDB($input);
        };
        $jawaban_alumni->alumni_answer_id = $alumni_answer->id;
        $jawaban_alumni->description = $input;
        $jawaban_alumni->is_multi = 0;
        $jawaban_alumni->save();

        DB::commit();

    }
    
    /** simpan jawaban tipe C */
    public function simpanJawabanKuesionerTipeC($alumni_answer, $request)
    {
        DB::beginTransaction();

        $jawaban_alumni = AlumniAnswerMultipleChoice::where('alumni_answer_id', $alumni_answer->id)
            ->where('kueswer_multiple_choice_id', $request['item_id'])
            ->first() ? : new AlumniAnswerMultipleChoice;
        
        $jawaban_alumni->alumni_answer_id = $alumni_answer->id;
        $jawaban_alumni->kueswer_multiple_choice_id = $request['item_id'] != id_item_other_answer() ? $request['item_id'] : null;
        $jawaban_alumni->is_use_other_answer = $request['item_id'] != id_item_other_answer() ? 0 : 1;
        $jawaban_alumni->save();

        /** jika ada jawaban lain */
        if (($request['input']) && ($request['item_id'] == id_item_other_answer())) {
            $jawaban_alumni = AlumniAnswerOther::where('alumni_answer_id', $alumni_answer->id)
                ->first() ? : new AlumniAnswerOther;

            $jawaban_alumni->alumni_answer_id = $alumni_answer->id;
            $jawaban_alumni->description = $request['input'];
            $jawaban_alumni->save();
        }

        DB::commit();
    }

    /** simpan jawaban tipe D */
    public function simpanJawabanKuesionerTipeD($alumni_answer, $request)
    {
        DB::beginTransaction();
        $multiple_choice_id = $request->multiple_choice_id;
        for ($i=0; $i < count($multiple_choice_id) ; $i++) { 
            $field_multiple_choice_itm_id = 'value_'.$multiple_choice_id[$i];

            $jawaban_alumni = AlumniAnswerMultipleChoiceItem::where('answer_id', $alumni_answer->id)
                ->where('kueswer_multiple_choice_id', $multiple_choice_id[$i])
                ->where('kueswer_multiple_choice_itm_id', $request[$field_multiple_choice_itm_id])
                ->first() ? : new AlumniAnswerMultipleChoiceItem;
            
            $jawaban_alumni->answer_id = $alumni_answer->id;
            $jawaban_alumni->kueswer_multiple_choice_id = $multiple_choice_id[$i];
            $jawaban_alumni->kueswer_multiple_choice_itm_id = $request[$field_multiple_choice_itm_id];
            $jawaban_alumni->save();

        }

        DB::commit();
    }

    /** simpan jawaban tipe E */
    public function simpanJawabanKuesionerTipeE($alumni_answer, $request)
    {
        DB::beginTransaction();
        $item_id = $request['item_id'];

        for ($i=0; $i < count($item_id); $i++) {
            /** Jika ada jawaban lain maka skip */
            $jawaban_alumni = AlumniAnswerMultipleChoice::where('alumni_answer_id', $alumni_answer->id)
                ->where('kueswer_multiple_choice_id', $item_id[$i])
                ->first() ? : new AlumniAnswerMultipleChoice;
            
            $jawaban_alumni->alumni_answer_id = $alumni_answer->id;
            $jawaban_alumni->kueswer_multiple_choice_id = $item_id[$i] != id_item_other_answer() ? $item_id[$i] : null;
            $jawaban_alumni->is_use_other_answer = $item_id[$i] != id_item_other_answer() ? 0 : 1;
            
            $jawaban_alumni->save();
        }

        /** jika ada jawaban lain */
        if ($request['input']) {
            $jawaban_alumni = AlumniAnswerOther::where('alumni_answer_id', $alumni_answer->id)
                ->first() ? : new AlumniAnswerOther;

            $jawaban_alumni->alumni_answer_id = $alumni_answer->id;
            $jawaban_alumni->description = $request['input'];
            $jawaban_alumni->save();
        }

        DB::commit();
    }

    /** kembali ke kuesioner sebelumnya */
    public function kuesionerBack()
    {
        $nrp = Cookie::get('nrp');
        $student = Student::where('nrp', $nrp)->where('status', 'L')->first();
        $periode = FrontHelper::getPeriode($nrp);
        $schedule = FrontHelper::getSchedule($student);
        
        $pertanyaan_terakhir = AlumniAnswer::where('periode_id', $periode->id)
            ->where('schedule_id', $schedule->id)
            ->where('nrp', $student->nrp)
            ->orderBy('id', 'desc')
            ->first();

        if (!$pertanyaan_terakhir) {
            return redirect('tracer-study');
        }

        $kuesioner_model_answer_id = $pertanyaan_terakhir->kuesioner->kuesioner_model_answer_id;
        // dd($pertanyaan_terakhir);
        // Cookie::queue('last_jenis_pertanyaan', $nrp, 500);


        $pertanyaan_terakhir->delete();
        return redirect('tracer-study/kuesioner');

    }
}