<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuesionerAnswerMultipleChoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kueswer_multiple_choice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kuesioner_id')->unsigned()->index('kuesioner_answer_mltchis_indx');
            $table->foreign('kuesioner_id', 'kuesioner_answer_mltchis_for')
                ->references('id')->on('kuesioner')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kueswer_multiple_choice');
    }
}
