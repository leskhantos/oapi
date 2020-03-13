<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_sms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date')->nullable()->index();
            $table->integer('company_id')->references('id')->on('companies');
            $table->integer('spot_id')->references('id')->on('spots');
            $table->integer('all')->default(0);
            $table->integer('resend')->default(0);
            $table->integer('delivered')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_sms');
    }
}
