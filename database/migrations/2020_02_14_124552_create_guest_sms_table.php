<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_sms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created')->nullable();
            $table->timestamp('expiration');
            $table->string('phone',20);
            $table->string('code',40);
            $table->string('device_mac',30);
            $table->integer('spot_id');
            $table->smallInteger('count_sessions')->nullable();
            $table->smallInteger('count_sms')->nullable();
            $table->timestamp('last_sms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_sms');
    }
}
