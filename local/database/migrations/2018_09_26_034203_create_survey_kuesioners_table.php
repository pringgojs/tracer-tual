<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyKuesionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_kuesioners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kuesioner');
            $table->integer('order_number')->unsigned()->nullable();
            $table->integer('periode_id')->unsigned()->index('kuesioner_periode_id_index');
            $table->foreign('periode_id', 'kuesioner_periode_id_foreign')
                ->references('id')->on('survey_periodes')
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
        Schema::dropIfExists('survey_kuesioners');
    }
}
