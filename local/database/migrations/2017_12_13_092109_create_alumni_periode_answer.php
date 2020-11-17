<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniPeriodeAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_periode_answer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity_id'); // if login with NRP, 'nrp' OR if user login with Google provide 'email
            $table->integer('periode_id')->unsigned()->index('apn_periode_ans_alumni_idx');
            $table->foreign('periode_id', 'apn_periode_ans_alumni_frg')
                ->references('id')->on('periode')
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
        Schema::dropIfExists('alumni_periode_answer');
    }
}
