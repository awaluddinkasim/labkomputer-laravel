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
        Schema::create('bebas_lab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('berkas');
            $table->string('bukti_bayar');
            $table->enum('status', ['pending', 'selesai', 'ditolak']);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')
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
        Schema::dropIfExists('bebas_lab');
    }
};
