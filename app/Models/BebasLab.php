<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BebasLab extends Model
{
    use HasFactory;

    protected $table = 'bebas_lab';

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
