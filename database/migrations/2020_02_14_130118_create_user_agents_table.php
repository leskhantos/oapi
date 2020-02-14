<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('info',300);
            $table->string('software',30)->nullable();
            $table->string('software_name',30)->nullable();
            $table->string('software_code',30)->nullable();
            $table->string('software_version',30)->nullable();
            $table->string('software_type',50)->nullable();
            $table->string('engine_name',30)->nullable();
            $table->string('engine_version',30)->nullable();
            $table->string('hardware_type',50)->nullable();
            $table->string('os',30)->nullable();
            $table->string('os_name',30)->nullable();
            $table->string('os_code',30)->nullable();
            $table->string('os_version',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_agents');
    }
}
