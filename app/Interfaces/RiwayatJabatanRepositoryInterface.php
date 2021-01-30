<?php

namespace App\Interfaces;

interface RiwayatJabatanRepositoryInterface
{
    public function get($params = null);

    public function truncate();
}
