<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sgtoSintomas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idSgtoSintomas');
            $table->string('iMatricula', 10)->nullable(false);
            $table->string('sintoma', 63)->nullable(false);
            $table->enum('gravedad', ['ninguno','leve','moderada','grave'])->nullable(false);
            $table->dateTime('fechaHora', 0)->nullable(false);

            $table->foreign('iMatricula')
                ->references('matricula')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sgtoSintomas');
    }
}
