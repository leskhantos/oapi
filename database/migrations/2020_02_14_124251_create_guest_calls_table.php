<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created')->nullable();
            $table->timestamp('expiration')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('device_mac',30);
            $table->integer('spot_id');
            $table->tinyInteger('checked')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_calls');
    }
}
