<?php

namespace App\Repositories;

use App\Interfaces\PosisiRepositoryInterface;
use App\Models\Posisi;

class SqlPosisiRepository implements PosisiRepositoryInterface
{
    public function get($params = null)
    {
        if($params)
            return Posisi::query()->where($params);
        return Posisi::query();
    }

    public function truncate()
    {
        Posisi::truncate();
    }
}
