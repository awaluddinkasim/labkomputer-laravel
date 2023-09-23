<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';
    protected $appends = ['tanggal'];

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM YYYY');
    }
}
