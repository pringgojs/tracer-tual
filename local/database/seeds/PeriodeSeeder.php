<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class PeriodeSeeder extends Seeder
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
        $this->output->writeln('<info>--- Periode Seeder Started ---</info>');
        $data = array(
            ['name' => 'Periode 2 tahun dari kelulusan', 'lower_limit' => 1,  'upper_limit' => 45],
            ['name' => 'Periode 5 tahun dari kelulusan', 'lower_limit' => 46,  'upper_limit' => 100]
        );
        \DB::table('periode')->insert($data);
        $this->output->writeln('<info>--- Periode Seeder finished ---</info>');
    }
}
