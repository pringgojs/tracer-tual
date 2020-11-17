<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePeriodeFieldSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surveys', function($table) {
            $table->dropColumn('periode_year');
            $table->dropColumn('periode_month');

            //  rename to 
            $table->string('periode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surveys', function($table) {
            $table->integer('periode_month')->nullable();
            $table->integer('periode_year')->nullable();

            $table->dropColumn('periode');
        });
    }
}
