<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuesionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kuesioner');
            $table->integer('kuesioner_model_answer_id')->unsigned()->index('kuesioner_model_answer_index');
            $table->foreign('kuesioner_model_answer_id', 'kuesioner_model_answer_foreign')
                ->references('id')->on('kuesioner_model_answer')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('kuesioner_group_id')->unsigned()->index('kuesioner_group_index')->nullable();
            $table->foreign('kuesioner_group_id', 'kuesioner_group_foreign')
                ->references('id')->on('kuesioner_group')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('order_number')->unsigned()->nullable(); // for order the kuesioner
            $table->boolean('is_required')->default(false); // is kuesioner requiered ?
            $table->boolean('is_published')->default(true); // is kuesioner published ?
            $table->boolean('is_use_logic')->default(false); // is kuesioner use conditional logic
            $table->string('type_of_field')->nullable(); // type of input field (type or number) to purpose validation form
            $table->boolean('add_other_answer')->default(false); // this field for type C
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
        Schema::dropIfExists('kuesioner');
    }
}
