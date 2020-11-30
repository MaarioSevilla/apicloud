<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sgtoTos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idSegtoTos');
            $table->string('iSTMatricula', 10)->nullable(false);
            $table->enum('gravedad', ['ninguno','leve','moderada','grave'])->nullable(false);
            $table->dateTime('fechaHora', 0)->nullable(false);

            $table->foreign('iSTMatricula')
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
        Schema::dropIfExists('sgtoTos');
    }
}
