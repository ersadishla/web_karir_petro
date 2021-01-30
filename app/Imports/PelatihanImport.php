<?php

namespace App\Imports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PelatihanImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        return new Pelatihan([
            'company_id' => $row['company_id'],
            'emp_no' => $row['emp_no'],
            'emp_history_no' => $row['emp_history_no'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'training_event_id' => $row['training_event_id'],
            'course_id' => $row['course_id'],
            'course_title' => $row['course_title'],
            'training_place' => $row['training_place'],
            'training_location' => $row['training_location'],
            'training_institution_name' => $row['training_institution_name'],
            'jenis' => $row['jenis'],
            'jenis_diklat' => $row['jenis_diklat'],
            'kompetensi_inti' => $row['kompetensi_inti'],
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
            '*.emp_history_no' => [
                'required',
                // 'unique:pelatihan,emp_history_no',
            ],
        ];
    }
}
