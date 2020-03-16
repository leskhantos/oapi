<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created');
            $table->integer('spot_id');
            $table->integer('list_id');
            $table->string('room',6)->nullable()->index();
            $table->string('code',10)->unique()->index();
            $table->timestamp('dt_start')->nullable();
            $table->timestamp('dt_end')->nullable();
            $table->smallInteger('can_used')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
