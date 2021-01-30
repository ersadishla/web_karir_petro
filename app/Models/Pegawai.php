<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Pelatihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'nik_sap';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'pegawai';

    protected $guarded = [];

    public $timestamps = true;

    protected $dates = ['tgl_lahir', 'tgl_masuk'];

    public function setTglLahirAttribute($rawDate)
    {
        $this->attributes['tgl_lahir'] = Carbon::instance(Date::excelToDateTimeObject($rawDate))->format('Y-m-d H:i:s');
    }

    public function setTglMasukAttribute($rawDate)
    {
        $this->attributes['tgl_masuk'] = Carbon::instance(Date::excelToDateTimeObject($rawDate))->format('Y-m-d H:i:s');
    }

    public function getFormattedTglLahirAttribute()
    {
        return Carbon::parse($this->attributes['tgl_lahir'])->translatedFormat('d F Y');
    }

    public function getFormattedTglMasukAttribute()
    {
        return Carbon::parse($this->attributes['tgl_masuk'])->translatedFormat('d F Y');
    }

    public function getMasaKerjaAttribute()
    {
        return Carbon::parse($this->attributes['tgl_masuk'])->diff(Carbon::now())->format('%y tahun %m bulan %d hari');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatJabatan::class, 'nik', 'nik')->orderBy('ma_tmt', 'asc');
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class, 'emp_no', 'nik_sap')->orderBy('start_date', 'asc');
    }

    public function pelatihanDN()
    {
        return $this->hasMany(Pelatihan::class, 'emp_no', 'nik_sap')->where('jenis', 'DP')->orWhere('jenis', 'LP-DN')->orWhereNull('jenis')->orderBy('start_date', 'asc');
    }

    public function pelatihanLN()
    {
        return $this->hasMany(Pelatihan::class, 'emp_no', 'nik_sap')->where('jenis', 'LP-LN')->orderBy('start_date', 'asc');
    }

    // public function getTglLahirAttribute()
    // {
    //     if($this->attributes['tgl_lahir'] === null) {
    //         return 'Kosong';
    //     }
    //     return date('d F Y', strtotime($this->attributes['tgl_lahir']));
    // }

    // public function getTglMasukAttribute()
    // {
    //     if($this->attributes['tgl_masuk'] === null) {
    //         return 'Kosong';
    //     }
    //     return date('d F Y', strtotime($this->attributes['tgl_masuk']));
    // }

    // public function getMasaKerjaAttribute()
    // {
    //     return Carbon::parse($this->attributes['tgl_masuk'])->diff(Carbon::now())->format('%y tahun %m bulan');
    // }
}
