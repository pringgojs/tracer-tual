<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniAnswerMultipleChoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_answer_multiple_choice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumni_answer_id')->unsigned()->index('xxaspaisd_index');
            $table->foreign('alumni_answer_id', 'xxaspaisd_foreign')
                ->references('id')->on('alumni_answer')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kueswer_multiple_choice_id')->unsigned()->index('asdjkl_index')->nullable();
            $table->foreign('kueswer_multiple_choice_id', 'asdjkl_foreign')
                ->references('id')->on('kueswer_multiple_choice')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_answer_multiple_choice');
    }
}
