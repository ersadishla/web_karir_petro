<?php

namespace App\Imports;

use App\Models\RiwayatJabatan;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RiwayatJabatanImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        return new RiwayatJabatan([
            'id' => $row['id'],
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'unitkerja' => $row['unitkerja'],
            'jabatan' => $row['jabatan'],
            'poscode' => $row['poscode'],
            'nm_jbt' => $row['nm_jbt'],
            'nm_pl' => $row['nm_pl'],
            'nm_ru' => $row['nm_ru'],
            'nm_si' => $row['nm_si'],
            'nm_bag' => $row['nm_bag'],
            'nm_dep' => $row['nm_dep'],
            'nm_kom' => $row['nm_kom'],
            'nm_dir' => $row['nm_dir'],
            'ma_tmt' => $row['ma_tmt'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '*.id' => ['required'],
        ];
    }
}
