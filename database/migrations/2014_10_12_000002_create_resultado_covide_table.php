<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoCovidETable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * cambiar a unique la matricula para evitar redundancia y datos extra
     */
    public function up()
    {
        Schema::create('resultadoCovidE', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idCov');
            $table->string('matriculai', 10)->nullable(false);
            $table->boolean('resultadoCovid')->nullable(false);
            $table->dateTime('fechaPositivoCE', 0)->nullable(true);
            $table->dateTime('fechaNegativoCE', 0)->nullable(true);

            $table->foreign('matriculai')
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
        Schema::dropIfExists('circuloEstudiantil');
    }
}
