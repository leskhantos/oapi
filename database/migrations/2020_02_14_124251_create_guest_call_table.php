<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_calls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created')->useCurrent();
            $table->timestamp('expiration')->nullable();
            $table->string('phone',20)->nullable()->index();
            $table->string('device_mac',30)->index();
            $table->integer('spot_id')->references('id')->on('spots');
            $table->boolean('checked')->default('0');
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
