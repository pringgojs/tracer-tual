<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuesionerLogicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_logic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kuesioner_id')->unsigned()->index('kuesioner_logic_kue_id_index');
            $table->foreign('kuesioner_id', 'kuesioner_logic_kue_id_foreign')
                ->references('id')->on('kuesioner')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kuesioner_id_ref')->unsigned()->index('kuesioner_logic_kueref_index');
            $table->foreign('kuesioner_id_ref', 'kuesioner_logic_kueref_foreign')
                ->references('id')->on('kuesioner')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('operator')->nullable(); // 'is' or 'is not'
            $table->integer('kueswer_multiple_choice_itm_id')->unsigned()->index('klkmcii_index');
            $table->foreign('kueswer_multiple_choice_itm_id', 'klkmcii_foreign')
                ->references('id')->on('kueswer_multiple_choice')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('type')->nullable(); // 'hide' or 'show'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kuesioner_logic');
    }
}
