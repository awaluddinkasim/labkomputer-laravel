<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function mahasiswa()
    {
        return $this->hasMany(User::class, 'id_prodi');
    }

    public function praktikum()
    {
        return $this->hasMany(Praktikum::class, 'id_prodi');
    }
}
