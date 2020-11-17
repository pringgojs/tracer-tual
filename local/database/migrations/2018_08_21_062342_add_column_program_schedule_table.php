<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProgramScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surveyors', function($table) {
            $table->integer('program')->nullable();
        });

        Schema::table('schedule', function($table) {
            $table->string('program')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surveyors', function($table) {
            $table->dropColumn('program');
        });

        Schema::table('surveyors', function($table) {
            $table->dropColumn('program')->nullable();
        });
    }
}
