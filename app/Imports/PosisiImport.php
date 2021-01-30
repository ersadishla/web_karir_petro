<?php

namespace App\Imports;

use App\Models\Posisi;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PosisiImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        return new Posisi([
            'poscode' => $row['poscode'],
            'postitle' => $row['postitle'],
            'dep' => $row['dep'],
            'directsuperior' => $row['directsuperior'],
            'directtitle' => $row['directtitle'],
            'jobid' => $row['jobid'],
            'jobtitle' => $row['jobtitle'],
            'orgcode' => $row['orgcode'],
            'regu' => $row['regu'],
            'seksi' => $row['seksi'],
            'bagian' => $row['bagian'],
            'departemen' => $row['departemen'],
            'kompartemen' => $row['kompartemen'],
            'direktorat' => $row['direktorat'],
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
            '*.poscode' => ['required'],
        ];
    }
}
