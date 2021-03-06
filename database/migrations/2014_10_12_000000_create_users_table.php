<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['admin', 'manager', 'support', 'client']);
            $table->integer('id_company')->default(0);
            $table->string('name', 150)->nullable();
            $table->string('login', 30)->unique()->index();
            $table->string('password', 60);
            $table->dateTime('last_online')->nullable();
            $table->string('last_ip', 50)->nullable();
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
        Schema::dropIfExists('users');
    }
}
