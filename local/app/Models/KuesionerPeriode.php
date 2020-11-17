<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuesionerPeriode extends Model
{
    protected $table = 'kuesioner_periode';   
    public $timestamps = false;

    public function kuesioner()
    {
        return $this->belongsTo('App\Models\Kuesioner', 'kuesioner_id');
    }

    public function scopeJoinKuesioner($q)
    {
        $q->join('kuesioner', 'kuesioner.id', '=', $this->table.'.kuesioner_id');
    }
}
