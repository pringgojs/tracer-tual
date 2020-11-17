<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_answer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kuesioner_id')->unsigned()->index('alumni_answer_kuesioner_index');
            $table->foreign('kuesioner_id', 'alumni_answer_kuesioner_freign')
                ->references('id')->on('kuesioner')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('nrp')->unsigned();
            $table->integer('alumni_id')->unsigned()->index('alumni_answer_alumni_index');
            $table->foreign('alumni_id', 'alumni_answer_alumni_foreign')
                ->references('id')->on('alumni')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('periode_id')->unsigned()->index('periode_answer_alumni_index');
            $table->foreign('periode_id', 'periode_answer_alumni_foreign')
                ->references('id')->on('periode')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('schedule_id')->unsigned()->index('schedule_answer_alumni_index');
            $table->foreign('schedule_id', 'schedule_answer_alumni_foreign')
                ->references('id')->on('schedule')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_answer');
    }
}
