<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('玩法组名称');
            $table->integer('lottery_type_id')->comment('彩票类型');
            $table->tinyInteger('status')->default(1)->comment('状态：0关闭， 1开启');
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('play_groups');
    }
}
