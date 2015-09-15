<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('whoable_type')->comment('');
            $table->string('whoable_id')->comment('');
            $table->tinyInteger('status')->comment('状态，0关闭，1 开启');
            $table->string('bank_id')->comment('银行地址id');
            $table->string('username')->comment('用户名');
            $table->string('account')->comment('账户');
            $table->string('bank_name')->comment('银行名称');
            $table->tinyInteger('sort')->comment('排序');
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
        Schema::dropIfExists('user_banks');
    }
}
