<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('Created');
            $table->string('mac');
            $table->string('type')->nullable();
            $table->string('os')->nullable();
            $table->string('os_version')->nullable();
            $table->smallInteger('screen_w')->nullable();
            $table->smallInteger('screen_h')->nullable();
            $table->string('info',300);
            $table->integer('sessions')->default(0);
            $table->timestamp('online');
            $table->timestamp('session')->nullable();
            $table->string('spot',50);
            $table->string('comment',300);
            $table->tinyInteger('update') ->default(10);
            $table->tinyInteger('blocked') ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
