<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniPeriodeGoogleAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('alumni_periode_google_auth', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->integer('periode_id')->unsigned()->index('apgagoole_index');
            $table->foreign('periode_id', 'apgagoole_foreign')
                ->references('id')->on('periode')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('is_done')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_periode_google_auth');
    }
}
