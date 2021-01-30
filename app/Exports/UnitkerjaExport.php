<?php

namespace App\Exports;

use App\Models\Unitkerja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitkerjaExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'unitkerja',
            'nm_unitkerja',
            'parentorgcode',
            'orglevelname',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Unitkerja::get([
            'unitkerja',
            'nm_unitkerja',
            'parentorgcode',
            'orglevelname',
        ]);
        //
    }
}
