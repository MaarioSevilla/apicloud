<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperaturaCE', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idSgtoTemp');
            $table->string('idMatricula', 10)->nullable(false);
            $table->dateTime('fecha', 0)->nullable(false);
            $table->string('temperatura', 4)->nullable(false);

            $table->foreign('idMatricula')
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
        Schema::dropIfExists('temperaturaCE');
    }
}
