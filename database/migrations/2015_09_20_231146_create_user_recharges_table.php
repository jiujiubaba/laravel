<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_recharges', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->comment('充值用户id');
            $table->string('username', 100)->comment('用户名');
            $table->decimal('money',10,2)->comment('充值金额');
            $table->string('sn', 30)->comment('充值编号');
            $table->string('remark', 20)->comment('充值备注编号');
            $table->decimal('before',10,2)->comment('充值前金额');
            $table->decimal('arrival_money', 10, 2)->comment('实际到账金额');
            $table->integer('bank_id')->comment('充值银行id');
            $table->integer('action_ip')->comment('充值ip地址');
            $table->integer('admin_id')->comment('管理员id');
            $table->integer('arrival_at')->comment('到账时间');
            $table->integer('red_id')->comment('红包id');
            $table->tinyInteger('is_red')->default(0)->comment('是否送红包:0 不送,1送');
            $table->tinyInteger('status')->comment('充值订单状态：0申请，1成功到账 2 失败');
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
        Schema::dropIfExists('user_recharges');
    }
}
