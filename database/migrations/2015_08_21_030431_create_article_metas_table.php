<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_metas', function($table){
            $table->increments('id');
            $table->string('name', 100)->default('')->comment('标签名称');
            $table->string('alias')->default('')->comment('别名');
            $table->integer('order')->default(0)->comment('标签名称排序');
            $table->integer('articles_cnt')->default(0)->comment('文章总数');
            $table->string('idcode',32)->comment('加密id码');

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
        Schema::dropIfExists('article_metas');
    }
}
