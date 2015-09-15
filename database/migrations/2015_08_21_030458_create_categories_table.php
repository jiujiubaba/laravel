<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoies', function($table){
            $table->increments('id');
            $table->string('name', 100)->default('')->comment('分类名称');
            $table->string('alias')->default('')->comment('别名');
            $table->integer('order')->default(0)->comment('分类排序');
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
        Schema::dropIfExists('categoies');
    }
}
