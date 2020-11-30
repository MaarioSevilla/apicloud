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
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->string('matricula', 10)->primary()->nullable(false);
            $table->string('email',255)->unique()->nullable(false);
            $table->string('password',255)->nullable(false);
            $table->string('nombre',63)->nullable(false);
            $table->string('apellido',39)->nullable(false);
            $table->string('apellidoII',39)->nullable(true);
            $table->enum('tipoUsuario', ['alumno','maestro','administrativo','doctor','otro'])->nullable(false);
            $table->timestamps();
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
