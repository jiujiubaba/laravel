<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function($table){
            $table->increments('id');
            $table->string('author', 100)->comment('作者名称');
            $table->tinyInteger('status')->default(0)->comment('状态: 0 草稿 1 发布 2 私密');
            $table->text('title')->default('')->comment('文章标题');
            $table->text('content')->default('')->comment('文章内容');
            $table->dateTime('published_at')->comment('发布时间');
            $table->integer('comments_cnt')->default(0)->comment('评论数');
            $table->integer('views_cnt')->default(0)->comment('浏览量');
            $table->string('link')->comment('文章链接');
            $table->string('idcode',32)->comment('加密id码');
            $table->integer('category_id')->comment('分类id');
            $table->string('category_idcord')->comment('分类id加密码');
            $table->string('terms')->default('')->comment('来源');
            $table->string('terms_link')->default('')->comment('来源连接');
            $table->tinyInteger('terms_type')->default('0')->comment('来源类型');
            $table->integer('article_meta_id')->comment('标签id');
            $table->string('article_meta_idcode')->comment('标签加密码');

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
        Schema::dropIfExists('articles');
    }
}
