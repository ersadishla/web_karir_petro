<?php

namespace App\Interfaces;

interface PegawaiRepositoryInterface
{
    public function get($params = null);

    public function find($nik_sap);

    public function truncate();
}
