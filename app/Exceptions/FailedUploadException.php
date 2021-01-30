<?php

namespace App\Exceptions;

use Exception;

class FailedUploadException extends Exception
{
    public function __construct()
    {
        parent::__construct('Gagal import data, silahkan coba lagi.', 500);
    }
}
