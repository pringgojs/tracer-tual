<?php

namespace App\Traits;

use App\Models\Kuesioner;
use App\Models\AlumniAnswer;
use App\Models\AlumniAnswerDescription;
use App\Models\AlumniAnswerMultipleChoice;
use App\Models\AlumniAnswerMultipleChoiceItem;

trait ChartGeneratorKuesionerTrait
{
    public static function chartModelA($kuesioner_id, $filter = [])
    {
        return AlumniAnswerDescription::joinAlumniAnswer()
            ->joinAlumni()
            ->where(function($query) use ($filter) {
                if ($filter) {
                    $tahun_lulus = $filter['tahun_lulus'];
                    $program_study = $filter['program_study'];
                    $schedule = $filter['schedule'];
                    $program = $filter['program'];

                    if ($tahun_lulus) {
                        $query->where('alumni.year_of_graduated', $tahun_lulus);
                    }

                    if ($program) {
                        $query->where('alumni.jenjang', $program);
                    }

                    if ($program_study) {
                        $query->where('alumni.program_study', $program_study);
                    }

                    if ($schedule) {
                        $query->where('alumni_answer.schedule_id', $schedule);
                    }
                } else {
                    $query->where('alumni_answer.schedule_id', max_schedule());
                }
            })
            ->where('alumni_answer.kuesioner_id', $kuesioner_id)
            ->selectRaw('description, count(alumni_answer_description.description) as total')
            ->groupBy('description')
            ->get();
    }

    public static function chartModelB($kuesioner_id, $filter = [])
    {
        return AlumniAnswer::joinAnswerDescription()
            ->joinAlumni()
            ->where(function($query) use ($filter) {
                if ($filter) {
                    $tahun_lulus = $filter['tahun_lulus'];
                    $program_study = $filter['program_study'];
                    $schedule = $filter['schedule'];
                    $program = $filter['program'];
                    if ($program) {
                        $query->where('alumni.jenjang', $program);
                    }

                    if ($tahun_lulus) {
                        $query->where('alumni.year_of_graduated', $tahun_lulus);
                    }


                    if ($program_study) {
                        $query->where('alumni.program_study', $program_study);
                    }

                    if ($schedule) {
                        $query->where('alumni_answer.schedule_id', $schedule);
                    }
                } else {
                    $query->where('alumni_answer.schedule_id', max_schedule());
                }
            })
            ->where('alumni_answer.kuesioner_id', $kuesioner_id)
            ->selectRaw('alumni_answer_description.description, count(alumni_answer_description.description) as total')
            ->groupBy('alumni_answer_description.description')
            ->get();
    }

    public static function chartModelC($kuesioner_id, $filter = [])
    {
        $alumni_answer_multiple_choice = AlumniAnswerMultipleChoice::joinAlumniAnswer()
            ->joinAlumni()
            ->where(function($query) use ($filter) {
                if ($filter) {
                    $tahun_lulus = $filter['tahun_lulus'];
                    $program_study = $filter['program_study'];
                    $schedule = $filter['schedule'];
                    $program = $filter['program'];
                    if ($program) {
                        $query->where('alumni.jenjang', $program);
                    }

                    if ($tahun_lulus) {
                        $query->where('alumni.year_of_graduated', $tahun_lulus);
                    }

                    if ($program_study) {
                        $query->where('alumni.program_study', $program_study);
                    }

                    if ($schedule) {
                        $query->where('alumni_answer.schedule_id', $schedule);
                    }
                } else {
                    $query->where('alumni_answer.schedule_id', max_schedule());
                }
            })
            ->where('alumni_answer.kuesioner_id', $kuesioner_id)
            ->selectRaw('alumni_answer_multiple_choice.kueswer_multiple_choice_id, count(alumni_answer_multiple_choice.kueswer_multiple_choice_id) as total')
            ->groupBy('alumni_answer_multiple_choice.kueswer_multiple_choice_id')
            ->get();

        if (!$alumni_answer_multiple_choice) return null;
        return $alumni_answer_multiple_choice;
    }
    
    public static function chartModelD($kuesioner_id, $filter = [])
    {
        return Kuesioner::find($kuesioner_id);
    }  

    /**
     * Rendering create form layout 
     */
    public static function chart($kuesioner_id, $filter = [])
    {
        $kuesioner = Kuesioner::find($kuesioner_id);
        if ($kuesioner->kuesioner_model_answer_id == 1) {
            return self::chartModelA($kuesioner_id, $filter);
        }

        if ($kuesioner->kuesioner_model_answer_id == 2) {
            return self::chartModelB($kuesioner_id, $filter);
        }

        if ($kuesioner->kuesioner_model_answer_id == 3) {
            return self::chartModelC($kuesioner_id, $filter);
        }

        if ($kuesioner->kuesioner_model_answer_id == 4) {
            return self::chartModelD($kuesioner_id, $filter);
        }

        if ($kuesioner->kuesioner_model_answer_id == 5) {
            return self::chartModelC($kuesioner_id, $filter);
        }
    }

    public function chasrtModelA()
    {
        echo '<table class="table table-responsive">';
        echo '<tr>
                <td>No</td>
                <td>Answer</td>
                <td>Count</td>
            </tr>';
        $i = 1;
        foreach($this->alumniAnswers as $alumni_answer) {

            echo '<tr>
                <td>'.$i++.'</td>
                <td>'.$alumni_answer->answerDescription->description.'</td>
                <td>Count</td>
            </tr>';
        }
        echo '</table>';
    }

}