<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TypeOfBusiness;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class TypeOfBusinessSeeder extends Seeder
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

        $data = "Manufacturing, Jasa (selain pendidikan dan konsultan), Konsultan, Pendidikan,Instansi Pemerintah, BUMN, Retail/Trade, Telekomunikasi, Pertambangan, Konstruksi, Perbankan, Kelistrikan, Industrial Robotic, Software Developer,  Pengusaha, IT Konsultan, Media Televisi, Oli & Gas,  Jasa Pelabuhan, Kuliner, Shipyard, IT Cloud Provider, Vendor Telekomunikasi, Heavy Equipment";
        $data = explode(',', $data);
        for($i=0; $i<count($data); $i++) {
            $type_of_business = new TypeOfBusiness;
            $type_of_business->name = trim($data[$i]);
            $type_of_business->notes = null;
            $type_of_business->save();
        }

        $this->output->writeln('<info>--- Type of business Seeder Finished ---</info>');

    }
}