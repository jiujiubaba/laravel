<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lottery_type_id')->comment('彩票类型');
            $table->integer('actionNo')->comment('开奖期号(当天的)');
            $table->dateTime('kaijiang_at')->comment('开奖时间');
            $table->dateTime('stoped_at')->comment('停止时间');
            $table->softDeletes();
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
        Schema::dropIfExists('data_times');
    }
}
