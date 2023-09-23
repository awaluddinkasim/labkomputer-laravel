<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = "fakultas";
    protected $with = ['prodi'];

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'id_fakultas')->orderBy('nama');
    }

    public function mahasiswa()
    {
        return $this->hasManyThrough(User::class, Prodi::class, 'id_fakultas', 'id_prodi');
    }
}
