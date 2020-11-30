<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoSintomasFamiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientoFamiliar', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idSgtoF');
            $table->foreignId('idsFamiliar')->nullable(false);
            $table->string('sintomaF', 63)->nullable(false);
            $table->enum('gravedadF', ['ninguno','leve','moderada','grave'])->nullable(false);
            $table->dateTime('fechaHoraF', 0)->nullable(false);
            $table->string('notaF', 255)->nullable(true);

            $table->foreign('idsFamiliar')
                ->references('idFamiliar')
                ->on('familiares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimientoFamiliar');
    }
}
