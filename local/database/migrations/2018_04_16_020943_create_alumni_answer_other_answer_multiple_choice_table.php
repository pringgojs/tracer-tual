<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniAnswerOtherAnswerMultipleChoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_answer_other', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumni_answer_id')->unsigned()->index('alumni_aswer_other_aai_index');
            $table->foreign('alumni_answer_id', 'alumni_aswer_other_aai_foreign')
                ->references('id')->on('alumni_answer')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_answer_other');
    }
}
