<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praktikum', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('semester');
            $table->enum('kategori', ['Ganjil', 'Genap']);
            $table->foreignId('id_prodi');
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('prodi')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('praktikum');
    }
};
