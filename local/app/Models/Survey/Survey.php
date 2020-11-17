<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'surveys';   
    public $timestamps = true;

    public function scopeMy($q)
    {
        $q->where('created_by', auth()->user()->id);
    }

    public function scopeCompany($q)
    {
        $q->where('status_account', 1);
    }
}
