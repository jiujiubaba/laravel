<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function($table){
            $table->increments('id');
            $table->string('name', 100)->comment('管理名称');
            $table->string('nickname', 100)->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->string('password')->comment('密码');
            $table->string('email',100)->comment('email');
            $table->string('user_tokens')->comment('用户token');
            $table->integer('last_ip')->comment('最后登录ip地址');
            $table->dateTime('last_login_at')->comment('最后登录时间');

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
        Schema::dropIfExists('admins');
    }
}
