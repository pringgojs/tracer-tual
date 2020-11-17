<?php

use App\Models\Kuesioner;
use App\Models\AlumniAnswer;
use Illuminate\Database\Seeder;
use App\Models\AlumniAnswerOther;
use Illuminate\Support\Facades\DB;
use App\Models\AlumniAnswerMultipleChoice;
use App\Models\KuesionerAnswerMultipleChoice;

class FixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $alumni_answer  = AlumniAnswer::joinKuesioner()
            ->where('kuesioner.kuesioner_model_answer_id', 3)
            ->select('alumni_answer.*')
            ->get();
        
            foreach($alumni_answer as $answer) {
                $kuesioner = Kuesioner::find($answer->kuesioner_id);
                $alumni_answer_multiple_choice = AlumniAnswerMultipleChoice::where('alumni_answer_id', $answer->id)->first();
                $details = KuesionerAnswerMultipleChoice::where('kuesioner_id', $kuesioner->id)->select('id')->get()->toArray();
                $details = array_flatten($details);
                if (!$alumni_answer_multiple_choice) {
                    $alumni_other_answer = AlumniAnswerOther::where('alumni_answer_id', $answer->id)->first();
                    if (!$alumni_other_answer) {
                        \Log::info($answer->id);
                    }
                }
                if ($alumni_answer_multiple_choice) {
                    if (!in_array($alumni_answer_multiple_choice->kueswer_multiple_choice_id, $details)) {
                        $first_array = array_first($details);
                        $alumni_answer_multiple_choice->kueswer_multiple_choice_id = $first_array;
                        $alumni_answer_multiple_choice->save();
                        \Log::info($first_array);
                        \Log::info('alumni_answer_id : '.$answer->id. ' =========== kuesioner : '.$kuesioner->id .' jawaban: '.$alumni_answer_multiple_choice->kueswer_multiple_choice_id);
                    }
                }
            }
            \Log::info('+++++++++++++++++++++++');
        
        DB::commit();
    }
}
