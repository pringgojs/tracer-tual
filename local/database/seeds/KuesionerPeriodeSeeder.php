<?php

use Illuminate\Database\Seeder;
use App\Models\KuesionerPeriode;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class KuesionerPeriodeSeeder extends Seeder
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
        $this->output->writeln('<info>--- Kueisoner Periode Seeder Started ---</info>');
        
        $data = array(1, 2, 3, 4, 5 );
        for ($i=0; $i < count($data); $i++) { 
            $kuesioner = new KuesionerPeriode;
            $kuesioner->periode_id = 1;
            $kuesioner->kuesioner_id = $data[$i];
            $kuesioner->number_order = $data[$i];
            $kuesioner->save();
        }
        
        $this->output->writeln('<info>--- Kueisoner Periode Seeder Finished ---</info>');
    }
}
