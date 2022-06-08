<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->integer('num_adquisicion');
            $table->string('titulo',255);
            $table->string('autor',255);
            $table->string('editorial',200);
            $table->string('pais',100);
            $table->string('anio',100);
            $table->string('num_paginas',50);
            $table->string('procedencia', 200);
            $table->string('clasificacion', 200);
            $table->string('ubicacion', 200);
            $table->string('codigo', 200);
            $table->date('fechaDeRegistro', 200);



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
        Schema::dropIfExists('libros');
    }
}
