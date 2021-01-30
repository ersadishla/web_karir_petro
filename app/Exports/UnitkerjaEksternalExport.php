<?php

namespace App\Exports;

use App\Models\UnitkerjaEksternal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitkerjaEksternalExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'unitkerja',
            'nm_unitkerja',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UnitkerjaEksternal::get([
            'unitkerja',
            'nm_unitkerja',
        ]);
        //
    }
}
