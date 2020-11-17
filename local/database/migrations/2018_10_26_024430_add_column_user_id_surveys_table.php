<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserIdSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surveys', function($table) {
            $table->integer('created_by')->unsigned()->index('surveys_user_id_index')->default(1);
            $table->foreign('created_by', 'surveys_user_id_foreign')
                ->references('id')->on('users')
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
        Schema::table('surveys', function($table) {
            $table->dropIndex('surveys_user_id_index');
            $table->dropForeign('surveys_user_id_foreign');
            $table->dropColumn('created_by');
        });
    }
}
