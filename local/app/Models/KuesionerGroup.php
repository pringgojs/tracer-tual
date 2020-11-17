<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuesionerGroup extends Model
{
    protected $table = 'kuesioner_group';   
    public $timestamps = false;

    public static function all($columns = ['*'])
    {
        $columns = is_array($columns) ? $columns : func_get_args();

        $instance = new static;

        return $instance->newQuery()->orderBy('order_number')->get($columns);
    }

    public function tempName()
    {
        return strtolower(str_replace(' ', '.', trim($this->name)));
    }
}
