<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familiares', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idFamiliar');
            $table->string('parentesco',63)->nullable(false);
            $table->string('nombreF',63)->nullable(false);
            $table->string('apellidoF',39)->nullable(false);
            $table->string('apellidoFII',39)->nullable(true);
            $table->string('idFMatricula',10)->nullable(false);

            $table->foreign('idFMatricula')
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
        Schema::dropIfExists('familiares');
    }
}
