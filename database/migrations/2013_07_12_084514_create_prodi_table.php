<?php

use App\Models\Prodi;
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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_fakultas');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('id_fakultas')->references('id')->on('fakultas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Prodi::insert([
            'id_fakultas' => 1,
            'nama' => 'Teknik Informatika'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodi');
    }
};
