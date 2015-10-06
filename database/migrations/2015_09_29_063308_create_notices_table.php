<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('status')->comment('状态: 0 不显示 1 显示');
            $table->string('title')->comment('公告标题');
            $table->text('content')->comment('公告内容');
            $table->text('admin_id')->comment('公告添加人');
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
        Schema::dropIfExists('notices');
    }
}
