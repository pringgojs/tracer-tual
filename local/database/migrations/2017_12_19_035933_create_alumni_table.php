<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('gender')->default(true);
            $table->string('generation');
            $table->integer('program_study')->unsigned();
            $table->integer('ipk')->unsigned()->nullable();
            $table->integer('year_of_entry');
            $table->integer('year_of_graduated');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('code_pos')->nullable();
            $table->string('province')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('nrp')->unsigned()->nullable();
            $table->integer('alumni_periode_answer_id')->unsigned()->index('almn_periode_ans_alumni_index');
            $table->foreign('alumni_periode_answer_id', 'almn_periode_ans_aluni_foreign')
                ->references('id')->on('alumni_periode_answer')
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
        Schema::dropIfExists('alumni');
    }
}
