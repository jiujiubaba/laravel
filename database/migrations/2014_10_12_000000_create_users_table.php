<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('old_password');
            $table->string('password')->comment('密码');
            $table->string('payment_password')->coment('支付密码');
            $table->string('nickname');
            $table->string('name');
            $table->string('email');
            $table->tinyInteger('type')->comment('会员类型0 普通会员 1代理');
            $table->decimal('fandian', 10, 1)->comment('用户返点');
            $table->decimal('bdw_fandian', 10, 1)->comment('不定位返点');
            $table->string('qq',15)->comment('');
            $table->integer('parent_id')->comment('上级');
            $table->string('ancestry')->comment('层级');
            $table->string('ancestry_depth')->comment('层级深度');
            $table->tinyInteger('level')->comment('用户等级');
            $table->tinyInteger('scores')->comment('用户积分');
            $table->decimal('cash', 10, 3)->comment('用户余额');
            $table->decimal('frozen_cash', 10, 3)->comment('冻结资金');
            $table->string('register_ip')->comment('注册ip');
            $table->tinyInteger('conCommStatus')->comment('消费佣金发放状态');
            $table->tinyInteger('lossCommStatus')->comment('亏损佣金发放状态');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
