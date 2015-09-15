<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lottery_type_id')->comment('投注彩票类型');
            $table->string('order_sn')->comment('订单号');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->integer('play_group_id')->default(0)->comment('玩法组id');
            $table->integer('play_id')->comment('玩法id');
            $table->string('actionNo')->comment('投注期号');
            $table->dateTime('actioned_at')->comment('投注时间');
            $table->integer('action_ip')->comment('投注ip');
            $table->integer('action_cnt')->comment('投注注数');
            $table->longText('action_data')->comment('投注号码');
            $table->string('example')->default('')->comment('中奖举例');
            $table->tinyInteger('Digit')->default(0)->comment('附加位数，一般用在任选位数上，个数用1,十位用2，百位用4...多位存储时可以用其和表示。,0一般是不保存位数用');
            $table->decimal('rebate',10,2)->comment('返点');
            $table->decimal('rebate_payed',10,3)->comment('支付的所有返点');
            $table->decimal('mode',10,2)->comment('模式，可以是2，0.20，0.02，分别代表元角分基数');
            $table->integer('beishu')->comment('倍数');
            $table->integer('bdw_enable')->comment('识别不定位投注');
            $table->integer('hm_enable')->comment('合买');
            $table->integer('fp_enable')->comment('飞盘，用于快8');
            $table->integer('zhuihao')->comment('追号剩下期数，为0时结束追号');
            $table->integer('zhuihao_mode')->comment('是否中奖停止追号');
            $table->decimal('bonus', 10, 2)->comment('奖金比例，中奖以这个为据');
            $table->string('lotteryNo')->comment('开奖号码，没开奖为空');
            $table->dateTime('kaijiang_at')->comment('开奖时间');
            $table->string('canceled')->comment('是否已经取消购买，一般在开奖之前都可以取消购买');
            $table->string('win_cnt')->comment('中奖注数');
            $table->decimal('win_bonus', 10, 2)->comment('中奖奖金');
            $table->tinyInteger('bet_type')->default(0)->comment('');
            $table->tinyInteger('flag')->default(0)->comment('识别盈亏');
            $table->tinyInteger('jrflag')->default(0)->comment('');
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
        Schema::dropIfExists('bets');
    }
}
