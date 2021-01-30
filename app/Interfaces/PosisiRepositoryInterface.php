<?php

namespace App\Interfaces;

interface PosisiRepositoryInterface
{
    public function get($params = null);

    public function truncate();
}
