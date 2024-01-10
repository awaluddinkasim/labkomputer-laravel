<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    use HasFactory;

    protected $table = 'slip';
    protected $appends = ['tanggal_slip', 'tanggal_upload'];

    public function dataPraktikan()
    {
        return $this->belongsTo(DataPraktikan::class, 'id_data');
    }

    public function getTanggalSlipAttribute()
    {
        return Carbon::parse($this->tgl_slip)->isoFormat('D MMMM YYYY');
    }

    public function getTanggalUploadAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM YYYY');
    }
}
