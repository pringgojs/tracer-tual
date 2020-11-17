<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniAnswerMultipleChoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_multiple_choice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer_id')->unsigned()->index('amcixxx_index');
            $table->foreign('answer_id', 'amcixxx_foreign')
                ->references('id')->on('alumni_answer')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kueswer_multiple_choice_id')->unsigned()->index('sdfdfsgweds_index')->nullable();
            $table->foreign('kueswer_multiple_choice_id', 'sdfdfsgweds_foreign')
                ->references('id')->on('kueswer_multiple_choice')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kueswer_multiple_choice_itm_id')->unsigned()->index('amciis_index');
            $table->foreign('kueswer_multiple_choice_itm_id', 'amciis_foreign')
                ->references('id')->on('kueswer_multiple_choice_item')
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
        Schema::dropIfExists('answer_multiple_choice_item');
    }
}
