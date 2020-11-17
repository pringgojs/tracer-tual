<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';
    public $timestamps = false;
    public $primaryKey = 'nomor';
    
    public function programStudy()
    {
        return $this->belongsTo('App\Models\ProgramStudy', 'jurusan');
    }

    public function programx()
    {
        return $this->belongsTo('App\Models\Program', 'program');
    }
}
