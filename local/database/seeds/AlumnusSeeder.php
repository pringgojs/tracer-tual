<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Alumnus;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class AlumnusSeeder extends Seeder
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
        $this->output->writeln('<info>--- Alumnus Seeder Started ---</info>');

        $data = array('Pringgo Juni S', 'Rudi Hermawan', 'Gracia Agustina', 'Mica Tamboyang', 'Emilia Rahma', 'Rido Riyanto');
        $nrp = array('2103177042','2103177043','2103177044','2103177045','2103177046','2103177047');
        $email = array('pringgojs@gmail.com', 'rudi@gmail.com', 'gracia@gmail.com', 'mica@gmail.com', 'emiilia@gmail.com', 'rido@gmail.com');
        $graduated_date = array('2017/06/12', '2017/06/12', '2015/06/12', '2015/06/12', '2014/06/12', '2010/06/12');
        for($i=0; $i<count($data); $i++) {
            $alumnus = new Alumnus;
            $alumnus->name = $data[$i];
            $alumnus->nrp = $nrp[$i];
            $alumnus->email = $email[$i];
            $alumnus->graduated_date = $graduated_date[$i];
            $alumnus->save();
        }

        $this->output->writeln('<info>--- Alumnus Seeder Finished ---</info>');

    }
}