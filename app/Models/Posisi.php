<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;

    protected $primaryKey = 'poscode';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'posisi';

    protected $guarded = [];

    public $timestamps = true;
}
