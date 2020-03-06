<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->nullable();
            $table->integer('spot_ident');
            $table->integer('spot_id');
            $table->string('phone');
            $table->string('device_mac',30);
            $table->string('message',100);
            $table->timestamp('dt_request')->nullable();
            $table->timestamp('dt_check')->nullable();
            $table->timestamp('dt_send')->nullable();
            $table->string('country',50)->nullable();
            $table->string('region',150)->nullable();
            $table->string('operator',30)->nullable();
            $table->float('price')->default(0);
            $table->string('sender')->nullable();
            $table->string('status_code')->default(-1);
            $table->string('status_text')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
