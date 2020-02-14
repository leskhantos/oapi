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
            $table->timestamp('created');
            $table->integer('user_id')->nullable();
            $table->string('redirect_url',200)->nullable();
            $table->integer('session_auto_timer')->nullable();
            $table->integer('session_timer')->nullable();
            $table->integer('wait_enter_timer')->nullable();
            $table->integer('sms_phone_limit')->nullable();
            $table->integer('sms_device_limit')->nullable();
            $table->integer('sms_life_timer')->nullable();
            $table->tinyInteger('sms_allow_country')->nullable();
            $table->integer('call_wait_timer')->nullable();
            $table->tinyInteger('call_allow_country')->nullable();
            $table->tinyInteger('monitoring_enabled')->nullable();
            $table->integer('monitoring_alert_timer')->nullable();
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
