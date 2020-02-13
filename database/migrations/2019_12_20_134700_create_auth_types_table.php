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
            $table->string('name', 60);
            $table->string('code', 20);
            $table->timestamps();
        });


        $rows[] = $this->row('Анкета', 'profile');
        $rows[] = $this->row('СМС', 'sms');
        $rows[] = $this->row('Код', 'code');
        $rows[] = $this->row('Кастомная авторизация', 'custom');
        $rows[] = $this->row('Звонок', 'call');
        $rows[] = $this->row('СМС-API', 'sms-api');
        $rows[] = $this->row('Без пароля', 'nopass');


        DB::table('auth_types')->insert($rows);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('auth_types');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

    private function row(string $name, string $code): array
    {
        return ['name' => $name, 'code' => $code, 'created_at' => now(), 'updated_at' => now()];
    }
}
