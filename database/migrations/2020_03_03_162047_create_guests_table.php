<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('datetime')->useCurrent();
            $table->integer('company_id')->references('company_id')->on('spots');
            $table->integer('spot_id')->references('id')->on('spots');
            $table->integer('spot_type')->references('type')->on('spots');
            $table->string('device_mac',17);
            $table->string('data_auth',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
