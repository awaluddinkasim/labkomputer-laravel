<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Setting::insert([
            [
                'name' => 'semester',
                'value' => 'ganjil',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'upload',
                'value' => 'tutup',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'kepala_lab',
                'value' => '8xxxxxxxxxx',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'asisten1',
                'value' => '8xxxxxxxxxx',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'asisten2',
                'value' => '8xxxxxxxxxx',
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
        Schema::dropIfExists('settings');
    }
};
