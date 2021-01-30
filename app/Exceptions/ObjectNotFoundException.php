<?php

namespace App\Exceptions;

use Exception;

class ObjectNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Data tidak ditemukan.', 422);
    }
}