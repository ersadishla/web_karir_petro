<?php

namespace App\Exports;

use App\Models\Pegawai;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PegawaiExport implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping
{
    public function headings(): array
    {
        return [
            'nik',
            'nik_sap',
            'nama',
            'eselon',
            'p_grade',
            'job_grade',
            'grade_sap',
            'statuspegawai',
            'nm_jabatan',
            'jabatan',
            'kode_unitkerja',
            'kode_dir',
            'kode_komp',
            'kode_dept',
            'kode_bagian',
            'kode_seksi',
            'direktorat',
            'kompartemen',
            'departemen',
            'bagian',
            'seksi',
            'regu',
            'poscode',
            'postitle',
            'alamat',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'propinsi',
            'kode_pos',
            'tmp_lahir',
            'tgl_lahir',
            'agama',
            'lp',
            'pendidikan',
            'jurusan',
            'institusi',
            'pend_akhir',
            'tgl_masuk',
        ];
    }

    public function map($pegawai): array
    {
        return [
            $pegawai->nik,
            $pegawai->nik_sap,
            $pegawai->nama,
            $pegawai->eselon,
            $pegawai->p_grade,
            $pegawai->job_grade,
            $pegawai->grade_sap,
            $pegawai->statuspegawai,
            $pegawai->nm_jabatan,
            $pegawai->jabatan,
            $pegawai->kode_unitkerja,
            $pegawai->kode_dir,
            $pegawai->kode_komp,
            $pegawai->kode_dept,
            $pegawai->kode_bagian,
            $pegawai->kode_seksi,
            $pegawai->direktorat,
            $pegawai->kompartemen,
            $pegawai->departemen,
            $pegawai->bagian,
            $pegawai->seksi,
            $pegawai->regu,
            $pegawai->poscode,
            $pegawai->postitle,
            $pegawai->alamat,
            $pegawai->kelurahan,
            $pegawai->kecamatan,
            $pegawai->kabupaten,
            $pegawai->propinsi,
            $pegawai->kode_pos,
            $pegawai->tmp_lahir,
            Date::dateTimeToExcel($pegawai->tgl_lahir),
            $pegawai->agama,
            $pegawai->lp,
            $pegawai->pendidikan,
            $pegawai->jurusan,
            $pegawai->institusi,
            $pegawai->pend_akhir,
            Date::dateTimeToExcel($pegawai->tgl_masuk),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'AF' => 'm/d/yyyy h:mm',
            'AM' => 'm/d/yyyy h:mm',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pegawai::all();
        //
    }
}
