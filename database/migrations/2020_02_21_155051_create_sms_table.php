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
            $table->increments('id');
            $table->string('uid',10)->nullable();
            $table->string('spot_ident',50);
            $table->integer('spot_id');
            $table->string('phone',30);
            $table->string('device_mac',30);
            $table->string('message',100);
            $table->timestamp('dt_request')->nullable();
            $table->timestamp('dt_check')->nullable();
            $table->timestamp('dt_send')->nullable();
            $table->string('country',50)->nullable();
            $table->string('region',150)->nullable();
            $table->string('operator',30)->nullable();
            $table->float('price')->default(0);
            $table->string('sender',20)->nullable();
            $table->string('status_code',5)->default(-1);
            $table->string('status_text',200)->nullable();
            $table->boolean('status')->default(0);
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
