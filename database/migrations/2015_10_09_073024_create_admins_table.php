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
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password')->comment('密码');
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->comment('用户头像');
            $table->tinyInteger('status')->default(0)->comment('账号状态 0 正常 1 禁用 2 锁定');
            $table->integer('sign_in_cnt')->default(0)->comment('登录次数统计');
            $table->dateTime('last_sign_in_at')->comment('最后登录时间');
            $table->integer('user_id')->comment('用户id');
            $table->string('last_sign_in_ip', 20)->comment('最后登录ip');
            $table->integer('failed_attempts')->comment('登录失败次数');
            $table->integer('locked_at')->comment('锁定时间');
            $table->softDeletes();
            $table->timestamps();
        });

        $user = User::saveData([
            'username'  => 'admin',
            'password'  => Hash::make('123456'),
            'nickname'  => '赵四',
            'category'  => 1,
            'type'      => 1,
            'ancestry_depth' => 0,
            'parent_id' => 0
        ]);

        $admin = [
            'username' => 'admin',
            'password'  => Hash::make('123456'),
            'name'      => 'admin',
            'status'    => 0,
            'user_id'   => $user->id
        ];

        // $a = Admin::saveData($admin);
        // DB::insert('');
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
