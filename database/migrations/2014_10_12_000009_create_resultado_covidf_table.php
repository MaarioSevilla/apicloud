<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoCovidFTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultadoCovidF', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idCovF');
            $table->foreignId('idFamiliarF')->nullable(false);
            $table->boolean('resultadoCovidF')->nullable(false);
            $table->dateTime('fechaCE', 0)->nullable(false);

            $table->foreign('idFamiliarF')
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
        Schema::dropIfExists('resultadoCovidF');
    }
}
