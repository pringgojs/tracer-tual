<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KuesionerGroup;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class KuesionerGroupSeeder extends Seeder
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
        $this->output->writeln('<info>--- Kuesioner Group Seeder Started ---</info>');

        $name = array('Pekerjaan', 'Perusahaan', 'Pekerjaan Detail');
        $link = array('pekerjaan', 'perusahaan', 'pekerjaan-detail');
        $icon = array('fa fa-rocket', 'fa fa-cubes', 'fa fa-crosshairs');
        $descs = array('Kuesioner tentang pekerjaan', 'Kuesioner tentang perusahaan', 'Kuesioner tentang pekerjaan lebih mendalam');
        for($i=0; $i<count($name); $i++) {
            $group = new KuesionerGroup;
            $group->name = $name[$i];
            $group->icon = $icon[$i];
            $group->link = $link[$i];
            $group->description = $descs[$i];
            $group->order_number = $i+1;
            $group->save();
        }

        $this->output->writeln('<info>--- Kuesioner Group Seeder Finished ---</info>');

    }
}