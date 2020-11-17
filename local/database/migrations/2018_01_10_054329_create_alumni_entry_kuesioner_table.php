<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniEntryKuesionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_entry_kuesioner', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('alumni_id')->unsigned()->index('sdfdswesdf_index');
            $table->foreign('alumni_id', 'sdfdswesdf_foreign')
                ->references('id')->on('alumni')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_entry_kuesioner');
    }
}
