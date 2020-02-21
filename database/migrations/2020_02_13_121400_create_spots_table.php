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
        Schema::enableForeignKeyConstraints();
        Schema::create('spots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->references('id')->on('companies');
            $table->integer('type')->references('id')->on('spots_types');
            $table->string('address', 200);
            $table->string('ident', 150)->index();
            $table->json('settings');
            $table->integer('page_id')->nullable();
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
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('spots');
//        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
