<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_withdraws', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->comment('提现用户id');
            $table->string('username', 100)->comment('用户名');
            $table->decimal('money',10,2)->comment('提现金额');
            // $table->string('bank_name')->comment('银行名称');
            // $table->string('name',30)->comment('开户名');
            // $table->string('account',32)->comment('银行账户');
            // $table->string('address')->comment('开户行地址');
            $table->string('sn', 30)->comment('提现编号');
            $table->integer('user_bank_id')->comment('用户设置银行id');
            $table->dateTime('payed_at')->comment('到账时间');
            $table->integer('admin_id')->comment('管理员id');
            $table->dateTime('canceled_at')->comment('取消时间');
            $table->dateTime('confirmed_at')->comment('确认时间');
            $table->tinyInteger('status')->comment('提现状态：1用户申请，2已取消，3已支付，4提现失败，0确认到帐, 5后台删除');
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
        Schema::dropIfExists('user_withdraws');
    }
}
