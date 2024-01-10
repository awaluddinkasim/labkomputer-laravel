<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    use HasFactory;

    protected $table = 'praktikum';
    protected $with = ['pengampu', 'prodi'];

    public function praktikan()
    {
        return $this->hasMany(DataPraktikan::class, 'id_praktikum');
    }

    public function pengampu()
    {
        return $this->hasMany(DataPengampu::class, 'id_praktikum');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function slip()
    {
        return $this->hasManyThrough(
            Slip::class,
            DataPraktikan::class,
            'id_praktikum',
            'id_data'
        )->orderBy('tgl_slip');
    }
}
