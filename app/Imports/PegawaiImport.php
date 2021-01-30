<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PegawaiImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        return new Pegawai([
            'nik' => $row['nik'],
            'nik_sap' => $row['nik_sap'],
            'nama' => $row['nama'],
            'eselon' => $row['eselon'],
            'p_grade' => $row['p_grade'],
            'job_grade' => $row['job_grade'],
            'grade_sap' => $row['grade_sap'],
            'statuspegawai' => $row['statuspegawai'],
            'nm_jabatan' => $row['nm_jabatan'],
            'jabatan' => $row['jabatan'],
            'kode_unitkerja' => $row['kode_unitkerja'],
            'kode_dir' => $row['kode_dir'],
            'kode_komp' => $row['kode_komp'],
            'kode_dept' => $row['kode_dept'],
            'kode_bagian' => $row['kode_bagian'],
            'kode_seksi' => $row['kode_seksi'],
            'direktorat' => $row['direktorat'],
            'kompartemen' => $row['kompartemen'],
            'departemen' => $row['departemen'],
            'bagian' => $row['bagian'],
            'seksi' => $row['seksi'],
            'regu' => $row['regu'],
            'poscode' => $row['poscode'],
            'postitle' => $row['postitle'],
            'alamat' => $row['alamat'],
            'kelurahan' => $row['kelurahan'],
            'kecamatan' => $row['kecamatan'],
            'kabupaten' => $row['kabupaten'],
            'propinsi' => $row['propinsi'],
            'kode_pos' => $row['kode_pos'],
            'tmp_lahir' => $row['tmp_lahir'],
            'tgl_lahir' => $row['tgl_lahir'],
            'agama' => $row['agama'],
            'lp' => $row['lp'],
            'pendidikan' => $row['pendidikan'],
            'jurusan' => $row['jurusan'],
            'institusi' => $row['institusi'],
            'pend_akhir' => $row['pend_akhir'],
            'tgl_masuk' => $row['tgl_masuk'],
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
            '*.nik_sap' => ['required'],
        ];
    }
}
