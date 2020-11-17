<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule', function($table) {
             $table->dropColumn('generation');
             $table->dropColumn('program_study');
             $table->dropColumn('program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule', function($table) {
            $table->integer('generation');
            $table->integer('program_study');
            $table->integer('program');
        });
    }
}
