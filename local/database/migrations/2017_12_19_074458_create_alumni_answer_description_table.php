<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniAnswerDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_answer_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumni_answer_id')->unsigned()->index('aadk_index');
            $table->foreign('alumni_answer_id', 'aadk_foreign')
                ->references('id')->on('alumni_answer')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('description');
            $table->boolean('is_multi'); // 1 multi, 0 single
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_answer_description');
    }
}
