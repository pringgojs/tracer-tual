<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KuesionerModelAnswer;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class KuesionerModelAnswerSeeder extends Seeder
{
    /**
     * @var Output
     */
    private $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->output->writeln('<info>--- Model Answer Seeder Started ---</info>');

        $notes = array('Pertanyaan dengan jawaban isian', 'Pertanyaan dengan jawaban isian lebih dari satu', 'Pertanyaan dengan jawaban pilihan ganda', 'Pertanyaan dengan jawaban pilihan ganda dan nilai', 'Pertanyaan dengan jawaban pilihan ganda lebih dari satu');
        $name = array('A', 'B', 'C', 'D', 'E');
        for($i=0; $i<count($notes); $i++) {
            $kuesioner_model_answer = new KuesionerModelAnswer;
            $kuesioner_model_answer->name = $name[$i];
            $kuesioner_model_answer->notes = $notes[$i];
            $kuesioner_model_answer->save();
        }

        $this->output->writeln('<info>--- Model Answer Seeder Finished ---</info>');
    }
}