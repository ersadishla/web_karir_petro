<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Karir extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'karir';

    protected $primaryKey = 'nik_sap';

    protected $guarded = [];
}
