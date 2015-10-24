<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0)->comment('会员类型');
            $table->string('code')->comment('推广码');
            $table->string('url')->comment('推广url');
            $table->decimal('fandian', 10, 2)->comment('返点');
            $table->integer('regiter_ip')->comment('添加ip');
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
        //
    }
}
