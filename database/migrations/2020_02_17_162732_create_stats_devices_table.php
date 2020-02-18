<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date')->nullable();
            $table->integer('company_id')->references('id')->on('companies');
            $table->integer('spot_id')->references('id')->on('spots');
            $table->integer('mobile')->default(0);
            $table->integer('tablet')->default(0);
            $table->integer('computer')->default(0);
            $table->integer('type_other')->default(0);
            $table->integer('android')->default(0);
            $table->integer('ios')->default(0);
            $table->integer('linux')->default(0);
            $table->integer('windows')->default(0);
            $table->integer('windows_phone')->default(0);
            $table->integer('os_other')->default(0);
            $table->integer('android_browser')->default(0);
            $table->integer('edge')->default(0);
            $table->integer('firefox')->default(0);
            $table->integer('chrome')->default(0);
            $table->integer('opera')->default(0);
            $table->integer('safari')->default(0);
            $table->integer('yandex_browser')->default(0);
            $table->integer('webkit')->default(0);
            $table->integer('browser_other')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_devices');
    }
}
