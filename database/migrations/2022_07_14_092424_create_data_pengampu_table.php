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
        Schema::create('data_pengampu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen');
            $table->foreignId('id_praktikum');
            $table->timestamps();

            $table->foreign('id_dosen')->references('id')->on('dosens')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_praktikum')->references('id')->on('praktikum')
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
        Schema::dropIfExists('data_pengampu');
    }
};
