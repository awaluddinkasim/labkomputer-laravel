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
        Schema::create('slip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_data');
            $table->string('slip');
            $table->date('tgl_slip');
            $table->integer('nominal');
            $table->timestamps();

            $table->foreign('id_data')->references('id')->on('data_praktikan')
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
        Schema::dropIfExists('slip');
    }
};
