<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserOtherAnswerMultiplechoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumni_answer_multiple_choice', function($table) {
            $table->boolean('is_use_other_answer')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumni_answer_multiple_choice', function($table) {
            $table->dropColumn('is_use_other_answer');
        });
    }
}
