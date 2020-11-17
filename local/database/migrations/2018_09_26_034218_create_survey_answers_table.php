<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kuesioner_id')->unsigned()->index('kuesioner_id_index')->nullable();
            $table->foreign('kuesioner_id', 'kuesioner_id_foreign')
                ->references('id')->on('survey_kuesioners')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('kuesioner_answer_id')->unsigned()->index('kuesioner_answer_id_index')->nullable();
            $table->foreign('kuesioner_answer_id', 'kuesioner_answer_id_foreign')
                ->references('id')->on('survey_kuesioner_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('survey_id')->unsigned()->index('survey_answer_s_index')->nullable();
            $table->foreign('survey_id', 'survey_answer_s_foreign')
                ->references('id')->on('surveys')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_answers');
    }
}
