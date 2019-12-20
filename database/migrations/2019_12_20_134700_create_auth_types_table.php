<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAuthTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->timestamps();
        });

        $types = ['call', 'sms', 'sms-api', 'code', 'profile', 'nopass', 'custom'];

        DB::table('auth_types')->insert(array_map(function ($type) {
            return ['name' => $type, 'created_at' => now(), 'updated_at' => now()];
        }, $types));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_types');
    }
}
