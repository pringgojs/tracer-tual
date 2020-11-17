<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EducationLevel;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class EducationLevelSeeder extends Seeder
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
        $this->output->writeln('<info>--- Education Level Seeder Started ---</info>');

        $data = array('D3', 'D4');
        
        for($i=0; $i<count($data); $i++) {
            $type_of_business = new EducationLevel;
            $type_of_business->name = $data[$i];
            $type_of_business->notes = null;
            $type_of_business->save();
        }

        $this->output->writeln('<info>--- EducationLevel Seeder Finished ---</info>');

    }
}