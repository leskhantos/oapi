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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('name', 50);
            $table->string('address', 160);
            $table->enum('type', ['sms', 'sms-api', 'ticket', 'data', 'nopass', 'call', 'custom']);
            $table->string('interface', 50);
            $table->string('ip', 30)->nullable();
            $table->enum('page_type', ['sms', 'call', 'ticket', 'data']);
            $table->json('settings')->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->boolean('disabled')->default(false);
            $table->string('debug_key', 50)->nullable();
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
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
