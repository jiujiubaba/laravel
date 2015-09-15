<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLevelsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('level')->comment('等级');
            $table->string('level_name')->comment('等级名称');
            $table->integer('min_score')->comment('最低积分');
            $table->tinyInteger('max_applywith_cnt')->comment('最大体现次数');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {      
        Schema::dropIfExists('user_levels');   
    }
}
