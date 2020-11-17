<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKueisonerAnswerBooleanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kueswer_boolean', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kuesioner_id')->unsigned()->index('kab_index');
            $table->foreign('kuesioner_id', 'kab_foreign')
                ->references('id')->on('kuesioner')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('notes')->nullable();
            $table->boolean('need_reason')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kueswer_boolean');
    }
}
