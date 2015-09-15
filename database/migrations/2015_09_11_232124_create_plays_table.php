<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('plays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lottery_type_id')->comment('彩票类型');
            $table->integer('play_group_id')->comment('玩法组');
            $table->tinyInteger('status')->default(1)->comment('状态：0关闭， 1开启');
            $table->decimal('max_bonus', 10, 2)->comment('最大奖金');
            $table->decimal('min_bonus', 10, 2)->comment('最低奖金');
            $table->tinyInteger('select_num_cnt')->default(0)->comment('每注选几个号码');
            $table->string('simple_info')->default('')->comment('玩法简单说明');
            $table->string('info')->default('')->comment('玩法说明');
            $table->string('example')->default('')->comment('中奖举例');
            $table->string('rule_fun', 32)->default('')->comment('中奖规则函数');
            $table->string('bet_cnt_fun', 20)->default('')->comment('赌注统计函数');
            $table->string('max_Win_cnt')->default('')->comment('最大中奖号码计算函数');
            $table->string('play_tpl')->default('')->comment('玩法页面模板');
            $table->integer('max_bet_cnt')->comment('最大投注数');
            $table->integer('sort')->comment('排序');
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
        Schema::dropIfExists('plays');
    }
}
