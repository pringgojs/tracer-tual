<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveySettingDashboardChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_setting_dashboard', function (Blueprint $table) {
            $table->increments('id');
            $table->text('json_layout')->nullable();
            $table->string('type_of_chart')->nullable(); // 1: pie, 2:bar
            $table->integer('kuesioner_id')->unsigned()->index('ssetting_dboard_kues_index');
            $table->foreign('kuesioner_id', 'ssetting_dboard_kues_foreign')
                ->references('id')->on('survey_kuesioners')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index('ssetting_user_kues_index');
            $table->foreign('user_id', 'ssetting_user_kues_foreign')
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
        Schema::dropIfExists('survey_setting_dashboard');
    }
}
