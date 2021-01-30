<?php

namespace App\Repositories;

use App\Interfaces\PelatihanRepositoryInterface;
use App\Models\Pelatihan;

class SqlPelatihanRepository implements PelatihanRepositoryInterface
{
    public function get($params = null)
    {
        if($params)
            return Pelatihan::query()->where($params);
        return Pelatihan::query();
    }

    public function truncate()
    {
        Pelatihan::truncate();
    }
}
