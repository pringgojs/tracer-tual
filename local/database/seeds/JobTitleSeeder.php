<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\JobTitle;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class JobTitleSeeder extends Seeder
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
        $this->output->writeln('<info>--- Type of business Seeder Started ---</info>');

        $data = array('Direktur (Owner)', 'Manager', 'System analyst', 'Asisten Manager',
         'Dosen', 'Karyawan PNS', 'Kepala Teknis', 'Programmer', 'Teknisi', 'Lain/lain');
        
        for($i=0; $i<count($data); $i++) {
            $type_of_business = new JobTitle;
            $type_of_business->name = $data[$i];
            $type_of_business->notes = null;
            $type_of_business->save();
        }

        $this->output->writeln('<info>--- Type of business Seeder Finished ---</info>');

    }
}