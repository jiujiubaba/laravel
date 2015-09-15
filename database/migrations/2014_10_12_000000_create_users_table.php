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
            $table->string('email');
            $table->integer('parent_id')->comment('上级');
            $table->string('ancestry')->comment('层级');
            $table->string('ancestry_depth')->comment('层级深度');
            $table->tinyInteger('level')->comment('用户等级');
            $table->tinyInteger('scores')->comment('用户积分');
            $table->decimal('cash', 10, 3)->comment('用户余额');
            $table->decimal('frozen_cash', 10, 3)->comment('冻结资金');
            $table->string('register_ip')->comment('注册ip');
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
