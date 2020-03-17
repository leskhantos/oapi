<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->references('id')->on('companies');
            $table->string('address', 200);
            $table->integer('type')->references('id')->on('spots_types');
            $table->string('ident', 150)->index();
            $table->json('settings')->nullable();
            $table->integer('style_id')->default(0);
            $table->timestamp('last_active')->nullable();
            $table->string('debug_key', 50)->nullable()->index();
            $table->boolean('enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spots');
    }
}
