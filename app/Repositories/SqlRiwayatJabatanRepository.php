<?php

namespace App\Repositories;

use App\Interfaces\RiwayatJabatanRepositoryInterface;
use App\Models\RiwayatJabatan;

class SqlRiwayatJabatanRepository implements RiwayatJabatanRepositoryInterface
{
    public function get($params = null)
    {
        if($params)
            return RiwayatJabatan::query()->where($params);
        return RiwayatJabatan::query();
    }

    public function truncate()
    {
        RiwayatJabatan::truncate();
    }
}
