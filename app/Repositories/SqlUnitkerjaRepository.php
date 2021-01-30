<?php

namespace App\Repositories;

use App\Interfaces\UnitkerjaRepositoryInterface;
use App\Models\Unitkerja;

class SqlUnitkerjaRepository implements UnitkerjaRepositoryInterface
{
    public function get($params = null)
    {
        if($params)
            return Unitkerja::query()->where($params);
        return Unitkerja::query();
    }

    public function truncate()
    {
        Unitkerja::truncate();
    }
}
