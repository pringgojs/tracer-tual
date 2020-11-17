<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuesionerAnswerBooleanReasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kueswer_boolean_reason', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kueswer_boolean_id')->unsigned()->index('kabr_index');
            $table->foreign('kueswer_boolean_id', 'kabr_foreign')
                ->references('id')->on('kueswer_boolean')
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
        Schema::dropIfExists('kueswer_boolean_reason');
    }
}
