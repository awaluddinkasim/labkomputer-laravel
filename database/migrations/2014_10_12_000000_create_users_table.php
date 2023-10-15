<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('password');
            $table->string('foto')->default('default.png');
            $table->foreignId('id_prodi');
            $table->enum('active', ['0', '1'])->default('0');
            $table->enum('level', ['asisten', 'mahasiswa'])->default('mahasiswa');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('prodi')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        $user = new User();
        $user->nim = "18024014111";
        $user->nama = "Awaluddin Kasim";
        $user->no_hp = "082191952371";
        $user->password = Hash::make('123');
        $user->id_prodi = 1;
        $user->active = '1';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
