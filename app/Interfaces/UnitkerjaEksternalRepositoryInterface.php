<?php

namespace App\Interfaces;

interface UnitkerjaEksternalRepositoryInterface
{
    public function get($params = null);

    public function truncate();
}
