<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyKuesionerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_kuesioner_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned()->index('survey_id_kuesioner_index');
            $table->foreign('survey_id', 'survey_id_kuesioner_foreign')
                ->references('id')->on('survey_kuesioners')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_kuesioner_details');
    }
}
