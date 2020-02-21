<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date')->nullable()->index();
            $table->integer('company_id')->references('id')->on('companies');
            $table->integer('spot_id')->references('id')->on('spots');
            $table->integer('load')->default(0);
            $table->integer('auth')->default(0);
            $table->integer('new')->default(0);
            $table->integer('old')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_guests');
    }
}
