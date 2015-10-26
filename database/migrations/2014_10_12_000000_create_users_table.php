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
            // 基本信息
            $table->increments('id');
            $table->string('username');
            $table->string('password')->comment('密码');
            $table->string('payment_password')->coment('支付密码');
            $table->string('nickname');
            $table->string('email');
            $table->tinyInteger('type')->comment('会员类型0 普通会员 1代理');
            $table->tinyInteger('status')->default(0)->comment('会员状态 0 正常使用 1 禁用');
            $table->tinyInteger('category')->default(0)->comment('用户种类 1 后台管理员 0 普通用户 2 系统用户');
            $table->decimal('fandian', 10, 1)->comment('用户返点');
            $table->string('qq',15)->comment('qq');
            $table->integer('parent_id')->comment('直属上级');
            $table->string('ancestry')->comment('层级');
            $table->string('ancestry_depth')->comment('层级深度');
            $table->tinyInteger('level')->comment('用户等级');
            $table->tinyInteger('scores')->comment('用户积分');
            $table->decimal('cashes', 10, 3)->comment('用户余额');
            // $table->decimal('frozen_cashes', 10, 3)->comment('冻结款');

            // 统计相关
            $table->integer('max_limit')->default(0)->comment('代理最大限额');
            $table->integer('register_ip')->comment('注册ip');
            $table->integer('last_sign_in_ip')->comment('最后登陆ip');
            $table->string('user_tokens')->comment('登陆token');
            $table->DateTime('last_sign_in_at')->comment('最后登陆时间');      
            $table->integer('sign_in_cnt')->default(0)->comment('登录次数统计');
            $table->tinyInteger('conCommStatus')->comment('消费佣金发放状态');
            $table->tinyInteger('lossCommStatus')->comment('亏损佣金发放状态');
            $table->decimal('profit', 10, 2)->comment('盈利统计');
            $table->decimal('loss', 10, 2)->comment('亏损统计');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
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
