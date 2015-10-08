<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->integer('to_user_id')->comment('接收信息用户id');
            $table->string('info')->comment('接收用户相关信息');
            $table->string('title')->comment('消息标题');
            $table->text('content')->comment('消息内容');
            $table->tinyInteger('is_read')->comment('是否已读');
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
        Schema::dropIfExists('messages');
    }
}
