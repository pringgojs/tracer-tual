<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kuesioner;
use App\Models\KuesionerAnswerMultipleChoice;
use App\Models\KuesionerAnswerMultipleChoiceItem;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class KuesionerSeeder extends Seeder
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
        $this->output->writeln('<info>--- Kuesioner Seeder Started ---</info>');

        // model A eassey
        $kuesioner = new Kuesioner;
        $kuesioner->kuesioner = 'Tahun Masuk PENS ?';
        $kuesioner->kuesioner_model_answer_id = 1;
        $kuesioner->kuesioner_group_id = 1;
        $kuesioner->order_number = 1;
        $kuesioner->is_required = 1;
        $kuesioner->is_published = 1;
        $kuesioner->type_of_field = "number";
        $kuesioner->created_at = date('Y-m-d');
        $kuesioner->updated_at = date('Y-m-d');
        
        $kuesioner->save();

        // model A eassey
        $kuesioner = new Kuesioner;
        $kuesioner->kuesioner = 'Alasan ganti ganti pekerjaan ?';
        $kuesioner->kuesioner_model_answer_id = 1;
        $kuesioner->kuesioner_group_id = 1;
        $kuesioner->order_number = 1;
        $kuesioner->is_required = 1;
        $kuesioner->is_published = 1;
        $kuesioner->type_of_field = "text";
        $kuesioner->created_at = date('Y-m-d');
        $kuesioner->updated_at = date('Y-m-d');
        
        $kuesioner->save();

        // model B eassey
        $kuesioner = new Kuesioner;
        $kuesioner->kuesioner = 'Dalam rangka penyempurnaan kurikulum yang ada di PENS sekarang, materi (mata kuliah) yang menurut anda belum diberikan saat kuliah di PENS dan bermanfaat dalam dunia kerja (sebutkan).';
        $kuesioner->kuesioner_model_answer_id = 2;
        $kuesioner->kuesioner_group_id = 1;
        $kuesioner->order_number = 1;
        $kuesioner->is_required = 1;
        $kuesioner->is_published = 1;
        $kuesioner->type_of_field = null;
        $kuesioner->created_at = date('Y-m-d');
        $kuesioner->updated_at = date('Y-m-d');
        $kuesioner->save();     

        // model C multiple choice
        $kuesioner = new Kuesioner;
        $kuesioner->kuesioner = 'Saat kuliah di PENS, sebenarnya di mana anda ingin bekerja ?';
        $kuesioner->kuesioner_model_answer_id = 3;
        $kuesioner->kuesioner_group_id = 1;
        $kuesioner->order_number = 2;
        $kuesioner->is_required = 1;
        $kuesioner->is_published = 1;
        $kuesioner->type_of_field = null;
        $kuesioner->created_at = date('Y-m-d');
        $kuesioner->updated_at = date('Y-m-d');
        
        $kuesioner->save();

        $notes = array('Wiraswasta', 'Perusahaan swasta', 'BUMN (Telkom/PLN/Pertamina/dll.)', 'PNS (Pemda, Departemen, dll.)', 'Dosen PTN', 'Lain-lain' );
        for ($i=0; $i < count($notes); $i++) { 
            $kuesioner_answer = new KuesionerAnswerMultipleChoice;
            $kuesioner_answer->kuesioner_id = $kuesioner->id;
            $kuesioner_answer->notes = $notes[$i];
            $kuesioner_answer->save();
        }
        
        // model D multiple choice with value
        $kuesioner = new Kuesioner;
        $kuesioner->kuesioner = 'Pengalaman yang memberikan kontribusi dalam dunia kerja ?';
        $kuesioner->kuesioner_model_answer_id = 4;
        $kuesioner->kuesioner_group_id = 1;
        $kuesioner->order_number = 1;
        $kuesioner->is_required = 1;
        $kuesioner->is_published = 1;
        $kuesioner->type_of_field = null;
        $kuesioner->created_at = date('Y-m-d');
        $kuesioner->updated_at = date('Y-m-d');
        $kuesioner->save();     

        $notes = array('Pengalaman belajar di kelas', 'Pengalaman belajar di laboratorium', 'Pengalaman belajar di Perusahaan');
        for ($i=0; $i < count($notes); $i++) { 
            $kuesioner_answer = new KuesionerAnswerMultipleChoice;
            $kuesioner_answer->kuesioner_id = $kuesioner->id;
            $kuesioner_answer->notes = $notes[$i];
            $kuesioner_answer->save();
        }
        
        $notes = array('Tidak penting', 'Kurang penting', 'Penting', 'Sangat penting');
        $value = array(1, 2, 3, 4);
        for ($i=0; $i < count($notes); $i++) { 
            $kuesioner_answer = new KuesionerAnswerMultipleChoiceItem;
            $kuesioner_answer->kuesioner_id = $kuesioner->id;
            $kuesioner_answer->notes = $notes[$i];
            $kuesioner_answer->value = $value[$i];
            $kuesioner_answer->save();
        }
        
        $this->output->writeln('<info>--- Kuesioner Seeder Finished ---</info>');

    }
}