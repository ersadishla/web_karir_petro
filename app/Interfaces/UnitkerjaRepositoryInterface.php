<?php

namespace App\Interfaces;

interface UnitkerjaRepositoryInterface
{
    public function get($params = null);

    public function truncate();
}
