<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('activated')->nullable();
            $table->timestamp('expiration');
            $table->integer('voucher_id')->references('id')->on('vouchers');
            $table->string('device_mac',30);
            $table->integer('spot_id')->references('id')->on('spots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_vouchers');
    }
}
