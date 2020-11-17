<?php

namespace App\Models;

use App\Models\Kuesioner;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    protected $table = 'kuesioner';
    public $timestamps = false;
    
    public static function all($columns = ['*'])
    {
        $columns = is_array($columns) ? $columns : func_get_args();

        $instance = new static;

        return $instance->newQuery()->orderBy('order_number')->get($columns);
    }

    public function scopePublished($q)
    {
        $q->where('is_published', 1);
    }

    public function group()
    {
        return $this->belongsTo('App\Models\KuesionerGroup', 'kuesioner_group_id');
    }

    public function modelAnswer()
    {
        return $this->belongsTo('App\Models\KuesionerModelAnswer', 'kuesioner_model_answer_id');
    }

    public function multipleChoice()
    {
        return $this->hasMany('App\Models\KuesionerAnswerMultipleChoice', 'kuesioner_id')->orderBy('id');
    }

    public function multipleChoiceItem()
    {
        return $this->hasMany('App\Models\KuesionerAnswerMultipleChoiceItem', 'kuesioner_id')->orderBy('value');
    }

    public function logic()
    {
        return $this->hasMany('App\Models\KuesionerLogic', 'kuesioner_id');
    }

    public function isPublished()
    {
        $label = '<label class="label label-rounded label-warning">Pending</label>';
        if ($this->is_published) {
            $label = '<label class="label label-rounded label-success">Published</label>';
        }
        return $label;
    }

    public function showLogic($kuesioner, $excel=null)
    {
        if ($this->logic) {
            $i = 1;
            foreach ($this->logic as $logic) {
                if ($excel) {
                    // echo  $i.". Tampilkan jika pertanyaan " .$logic->ref->kuesioner." mempunyai jawaban  " . $logic->refItem->notes;
                } else {
                    echo  $i.". Tampilkan jika pertanyaan <b style='color: red'> " .$logic->ref->kuesioner." </b> mempunyai jawaban  <b style='color: red'>" . $logic->refItem->notes ."</b> <br><br>";

                }
    

                $i++;
            }
            
        }
    }

    public static function getKuesionerRef($group_id, $kuesioner_id)
    {
        return Kuesioner::where('kuesioner_group_id', $group_id)
            ->where('id', '!=', $kuesioner_id)
            ->where('kuesioner_model_answer_id', 3) // 3 Model type C
            ->get();
    }

    /** cek jenis kuesioner */
    public function tipeA()
    {
        if ($this->kuesioner_model_answer_id == 1) return true;

        return false;
    }
    
    public function tipeB()
    {
        if ($this->kuesioner_model_answer_id == 2) return true;

        return false;
    }
    
    public function tipeC()
    {
        if ($this->kuesioner_model_answer_id == 3) return true;

        return false;
    }

    public function tipeD()
    {
        if ($this->kuesioner_model_answer_id == 4) return true;

        return false;
    }

    public function tipeE()
    {
        if ($this->kuesioner_model_answer_id == 5) return true;

        return false;
    }
}
