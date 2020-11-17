<?php

use Illuminate\Database\Seeder;
use App\Models\Survey\SurveyPeriode;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class SurveyPeriodeSeeder extends Seeder
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
        $this->output->writeln('<info>--- User Survey Periode Seeder Started ---</info>');
        $periode = new SurveyPeriode;
        $periode->name = 'User Survey 2018';
        $periode->save();

        $this->output->writeln('<info>--- User Survey Periode Seeder Finished ---</info>');
    }
}
