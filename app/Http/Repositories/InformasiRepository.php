<?php

namespace App\Http\Repositories;

use Carbon\Carbon;
use App\Models\Informasi;
use App\Events\InformationDeleted;
use App\Events\InformationSubmitted;
use App\Events\InformationUpdated;

class InformasiRepository
{
    protected $informasi;

    public function __construct(Informasi $informasi)
    {
        $this->informasi = $informasi;
    }

    public function get()
    {
        return $this->informasi::orderBy('created_at', 'DESC')->paginate(3);
    }

    public function getById($id)
    {
        return $this->informasi::find($id);
    }

    public function getFromMonth($month)
    {
        return $this->informasi->whereBetween('created_at', [Carbon::now()->subMonth($month), Carbon::now()])->orderBy('created_at', 'DESC')->get();
    }

    public function save($data)
    {
        $info = new $this->informasi();
        $info->judul = $data->judul;
        $info->konten = $data->konten;
        $info->save();

        event(new InformationSubmitted($info, "Informasi dengan judul " . $data->judul . " telah ditambahkan"));

        return $info;
    }

    public function update($data)
    {
        $info = $this->informasi::find($data->id);
        $info->judul = $data->judul;
        $info->konten = $data->konten;
        $info->update();

        event(new InformationUpdated($info, "Informasi dengan judul " . $data->judul . " telah diperbaharui"));

        return $info;
    }

    public function destroy($id)
    {
        $informasi = Informasi::find($id);
        $judul = $informasi->judul;
        $informasi->delete();

        event(new InformationDeleted($id, "Informasi dengan judul " . $judul . " telah dihapus"));
    }
}
