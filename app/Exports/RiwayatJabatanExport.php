<?php

namespace App\Exports;

use App\Models\RiwayatJabatan;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class RiwayatJabatanExport implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping
{
    public function headings(): array
    {
        return [
            'id',
            'nik',
            'nama',
            'unitkerja',
            'jabatan',
            'poscode',
            'nm_jbt',
            'nm_pl',
            'nm_ru',
            'nm_si',
            'nm_bag',
            'nm_dep',
            'nm_kom',
            'nm_dir',
            'ma_tmt',
        ];
    }

    public function map($riwayat): array
    {
        return [
            $riwayat->id,
            $riwayat->nik,
            $riwayat->nama,
            $riwayat->unitkerja,
            $riwayat->jabatan,
            $riwayat->poscode,
            $riwayat->nm_jbt,
            $riwayat->nm_pl,
            $riwayat->nm_ru,
            $riwayat->nm_si,
            $riwayat->nm_bag,
            $riwayat->nm_dep,
            $riwayat->nm_kom,
            $riwayat->nm_dir,
            Date::dateTimeToExcel($riwayat->ma_tmt),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'O' => 'm/d/yyyy h:mm',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RiwayatJabatan::all();
        //
    }
}
