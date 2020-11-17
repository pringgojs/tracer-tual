<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingDashboardChart extends Model
{
    protected $table = 'setting_dashboard_chart';
    public $timestamps = false;

    public function kuesioner()
    {
        return $this->belongsTo('App\Models\Kuesioner', 'kuesioner_id');
    }
}