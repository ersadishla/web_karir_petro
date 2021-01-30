<?php

namespace App\Exports;

use App\Models\Posisi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PosisiExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'poscode',
            'postitle',
            'dep',
            'directsuperior',
            'directtitle',
            'jobid',
            'jobtitle',
            'orgcode',
            'regu',
            'seksi',
            'bagian',
            'departemen',
            'kompartemen',
            'direktorat',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Posisi::get([
            'poscode',
            'postitle',
            'dep',
            'directsuperior',
            'directtitle',
            'jobid',
            'jobtitle',
            'orgcode',
            'regu',
            'seksi',
            'bagian',
            'departemen',
            'kompartemen',
            'direktorat',
        ]);
        //
    }
}
