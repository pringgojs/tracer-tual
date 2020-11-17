<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumni', function($table) {
            $table->integer('kode_prodi')->unsigned()->nullable();
            $table->integer('kode_perguruan_tinggi')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumni', function($table) {
            $table->dropColumn('kode_prodi', 'kode_perguruan_tinggi');
        });
    }
}
