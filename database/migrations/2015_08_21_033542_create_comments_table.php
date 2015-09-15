<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function($table){
            $table->increments('id');
            $table->integer('article_id')->comment('评论文章id');
            $table->string('author', 100)->comment('作者昵称');
            $table->string('email')->comment('电子邮件');
            $table->string('url')->comment('url');
            $table->string('ip',100)->comment('评论者ip');
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
         Schema::dropIfExists('comments');
    }
}
