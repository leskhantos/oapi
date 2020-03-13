<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created')->nullable();
            $table->integer('user_id')->references('id')->on('users');
            $table->string('redirect_url',200)->default('https://oy2b.ru/wifiok');
            $table->smallInteger('session_auto_timer')->nullable();
            $table->smallInteger('session_timer')->nullable();
            $table->tinyInteger('wait_enter_timer')->nullable();
            $table->tinyInteger('sms_phone_limit')->nullable();
            $table->tinyInteger('sms_device_limit')->nullable();
            $table->tinyInteger('sms_life_timer')->nullable();
            $table->boolean('sms_allow_country')->nullable();
            $table->smallInteger('call_wait_timer')->nullable();
            $table->tinyInteger('call_allow_country')->nullable();
            $table->smallInteger('voucher_max_devices')->nullable();
            $table->boolean('monitoring_enabled')->nullable();
            $table->smallInteger('monitoring_alert_timer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_settings');
    }
}
