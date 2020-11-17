<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingDashboardChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_dashboard_chart', function (Blueprint $table) {
            $table->increments('id');
            $table->text('json_layout')->nullable();
            $table->string('type_of_chart'); // 1: pie, 2:bar
            $table->integer('kuesioner_id')->unsigned()->index('setting_dashboard_kues_index');
            $table->foreign('kuesioner_id', 'setting_dashboard_kues_foreign')
                ->references('id')->on('kuesioner')
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
        Schema::dropIfExists('setting_dashboard_chart');
    }
}
