<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions_auths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spot_id')->references('id')->on('spots');
            $table->timestamp('created')->useCurrent();
            $table->timestamp('expiration')->nullable();
            $table->timestamp('used')->nullable();
            $table->string('device_mac',30)->index();
            $table->string('signature',40)->index();
            $table->integer('counter')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions_auths');
    }
}
