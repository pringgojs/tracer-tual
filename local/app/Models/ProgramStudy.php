<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudy extends Model
{
    protected $table = 'study_programs';   
    public $timestamps = false;
    public $primaryKey = 'nomor';
}
