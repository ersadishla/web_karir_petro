<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Posisi;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatJabatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'riwayat_jabatan';

    protected $guarded = [];

    public $timestamps = true;

    protected $dates = ['ma_tmt'];

    public function setMaTmtAttribute($rawDate)
    {
        $this->attributes['ma_tmt'] = Carbon::instance(Date::excelToDateTimeObject($rawDate))->format('Y-m-d H:i:s');
    }

    public function getFormattedMaTmtAttribute()
    {
        return Carbon::parse($this->attributes['ma_tmt'])->translatedFormat('d-m-Y');
    }

    public function getFormattedMaSlsAttribute()
    {
        return $this->attributes['ma_sls'] ? Carbon::parse($this->attributes['ma_sls'])->translatedFormat('d-m-Y') : 'Sekarang';
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'poscode', 'poscode');
    }

    public function unitkerja()
    {
        return $this->belongsTo(Unitkerja::class, 'unitkerja', 'unitkerja');
    }
}
