<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('nrp')->nullable();
            $table->text('token')->nullable();
            $table->boolean('is_google_auth')->default(false);
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_user');
    }
}
