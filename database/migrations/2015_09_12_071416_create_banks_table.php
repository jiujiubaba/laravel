<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->comment('银行名称');
            $table->tinyInteger('status')->comment('状态，0关闭，1 开启');
            $table->string('logo')->comment('logo地址');
            $table->string('home_page')->comment('银行主页');
            $table->tinyInteger('recharge_status')->default(0)->comment('是否开启充值 0 否 1 是');
            $table->tinyInteger('withdraw_status')->default(0)->comment('是否开启提现 0 否 1 是');
            $table->string('alias', 20)->comment('名称缩写');
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
        Schema::dropIfExists('banks');
    }
}
