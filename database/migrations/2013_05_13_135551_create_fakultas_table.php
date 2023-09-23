<?php

use App\Models\Fakultas;
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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Fakultas::insert([
            [
                'nama' => "Teknik",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => "Keguruan dan Ilmu Pendidikan",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => "Pertanian",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => "Ilmu Sosial dan Ilmu Politik",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => "Matematika dan Ilmu Pengetahuan Alam",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fakultas');
    }
};
