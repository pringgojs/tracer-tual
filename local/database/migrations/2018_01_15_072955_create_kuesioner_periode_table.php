<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuesionerPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_periode', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('periode_id')->unsigned()->index('kueisoner_periode_id_index');
            $table->foreign('periode_id', 'kueisoner_periode_id_foreign')
                ->references('id')->on('periode')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kuesioner_id')->unsigned()->index('kuesioner_id_periode_index');
            $table->foreign('kuesioner_id', 'kuesioner_id_periode_foreign')
                ->references('id')->on('kuesioner')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('number_order')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kuesioner_periode');
    }
}
