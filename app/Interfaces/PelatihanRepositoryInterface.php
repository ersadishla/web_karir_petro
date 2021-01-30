<?php

namespace App\Interfaces;

interface PelatihanRepositoryInterface
{
    public function get($params = null);

    public function truncate();
}
