<?php

namespace App\Exports;

use App\Models\Pelatihan;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PelatihanExport implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping
{
    public function headings(): array
    {
        return [
            'company_id',
            'emp_no',
            'emp_history_no',
            'start_date',
            'end_date',
            'training_event_id',
            'course_id',
            'course_title',
            'training_place',
            'training_location',
            'training_institution_name',
            'jenis',
            'jenis_diklat',
            'kompetensi_inti',
        ];
    }

    public function map($pelatihan): array
    {
        return [
            $pelatihan->company_id,
            $pelatihan->emp_no,
            $pelatihan->emp_history_no,
            Date::dateTimeToExcel($pelatihan->start_date),
            Date::dateTimeToExcel($pelatihan->end_date),
            $pelatihan->training_event_id,
            $pelatihan->course_id,
            $pelatihan->course_title,
            $pelatihan->training_place,
            $pelatihan->training_location,
            $pelatihan->training_institution_name,
            $pelatihan->jenis,
            $pelatihan->jenis_diklat,
            $pelatihan->kompetensi_inti,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => 'm/d/yyyy h:mm',
            'E' => 'm/d/yyyy h:mm',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pelatihan::all();
        //
    }
}
