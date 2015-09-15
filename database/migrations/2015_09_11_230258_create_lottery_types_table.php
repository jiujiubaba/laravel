<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotteryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->comment('彩票类型:1时时彩，2十一选五，33D/P3/时时乐，4快乐十分，5广西快乐十分');
            $table->tinyInteger('status')->comment('状态：0关闭， 1开启');
            $table->integer('sort')->default(0);
            $table->string('name');
            $table->string('code_list')->comment('彩票可选号码列表，用半角逗号分隔');
            $table->string('title')->default('')->comment('标题');
            $table->string('short_name')->default('');
            $table->string('info')->default('')->comment('信息说明');
            $table->string('on_get_noed')->default('')->comment('请求当前期号后置事件函数');
            $table->integer('data_ftime')->default(0)->comment('开奖前停止下注时间');
            $table->tinyInteger('default_view_group')->comment('默认显示玩法组');
            $table->integer('num')->comment('彩种期数');
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
        Schema::dropIfExists('lottery_types');
    }
}
