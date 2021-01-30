<?php

namespace App\Repositories;

use App\Interfaces\UnitkerjaEksternalRepositoryInterface;
use App\Models\UnitkerjaEksternal;

class SqlUnitkerjaEksternalRepository implements UnitkerjaEksternalRepositoryInterface
{
    public function get($params = null)
    {
        if($params)
            return UnitkerjaEksternal::query()->where($params);
        return UnitkerjaEksternal::query();
    }

    public function truncate()
    {
        UnitkerjaEksternal::truncate();
    }
}
