<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned()->index('detail_schedule_id_index');
            $table->foreign('schedule_id', 'detail_schedule_id_foreign')
                ->references('id')->on('schedule')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('generation')->unsigned();
            $table->integer('program_study_id')->unsigned();
            $table->integer('program_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_details');
    }
}
