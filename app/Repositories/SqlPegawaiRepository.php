<?php

namespace App\Repositories;

use App\Interfaces\PegawaiRepositoryInterface;
use App\Models\Pegawai;

class SqlPegawaiRepository implements PegawaiRepositoryInterface
{
    public function get($params = null)
    {
        if($params)
            return Pegawai::query()->where($params);
        return Pegawai::query();
    }

    public function find($nik_sap)
    {
        return Pegawai::with([
            'riwayat',
            'riwayat.posisi',
            'pelatihanDN',
            'pelatihanLN',
        ])->where('nik_sap', $nik_sap)->first();
    }

    public function truncate()
    {
        Pegawai::truncate();
    }
}
