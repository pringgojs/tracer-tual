<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniAnswerBooleanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_answer_boolean', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumni_answer_id')->unsigned()->index('alumni_answer_boolean_index');
            $table->foreign('alumni_answer_id', 'alumni_answer_boolean_foreign')
                ->references('id')->on('alumni_answer')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kueswer_boolean_id')->unsigned()->index('kjlosdmfk_index');
            $table->foreign('kueswer_boolean_id', 'kjlosdmfk_foreign')
                ->references('id')->on('kueswer_boolean')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kueswer_boolean_reason_id')->unsigned()->index('osmdjswbhjas_index');
            $table->foreign('kueswer_boolean_reason_id', 'osmdjswbhjas_foreign')
                ->references('id')->on('kueswer_boolean_reason')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_answer_boolean');
    }
}
