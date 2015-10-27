<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flows', function(Blueprint $table)
        {
            $table->increments('id');
            $table->morphs('whoable');
            $table->decimal('before',10,2)->comment('变化前的金额'); 
            $table->decimal('after',10,2)->comment('变化后的金额');
            $table->decimal('change',10,2)->comment('变化的金额');
            $table->tinyInteger('type')->comment('流水类型');
            $table->morphs('cashable');
            // $table->integer('betch')->comment('批次');
            $table->tinyInteger('status')->comment('状态 0:流入, 1:流出');
            $table->string('info')->comment('说明');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_flows');
    }
}
