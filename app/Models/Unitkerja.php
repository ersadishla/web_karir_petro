<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitkerja extends Model
{
    use HasFactory;

    protected $primaryKey = 'unitkerja';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'unitkerja';

    protected $guarded = [];

    public $timestamps = true;
}
