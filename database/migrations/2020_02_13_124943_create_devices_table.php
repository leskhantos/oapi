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
            $table->timestamp('created');
            $table->string('mac')->index();
            $table->string('type')->nullable();
            $table->string('os')->nullable();
            $table->string('os_version')->nullable();
            $table->smallInteger('screen_w')->nullable();
            $table->smallInteger('screen_h')->nullable();
            $table->string('info',300)->default('');
            $table->integer('sessions')->default(0);
            $table->integer('spot_id')->nullable()->index();
            $table->timestamp('last_online')->nullable();
            $table->timestamp('last_session')->nullable();
            $table->string('comment',300)->default('');
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
