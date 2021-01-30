<?php

namespace App\Repositories;

use App\Interfaces\KarirRepositoryInterface;
use App\Models\Karir;

class SqlKarirRepository implements KarirRepositoryInterface
{
    public function process($karir, $pegawai, $unitkerja_eksternal)
    {
        $karir_eksternal = [];
        $karir_internal = [];
        $pelatihanDN = [];
        $pelatihanLN = [];

        $karir->nik = $pegawai->nik;
        $karir->nik_sap = $pegawai->nik_sap;
        $karir->nama = $pegawai->nama;
        $karir->nm_jabatan = $pegawai->nm_jabatan;
        $karir->p_grade = $pegawai->p_grade;
        $karir->tmp_lahir = $pegawai->tmp_lahir;
        $karir->tgl_lahir = $pegawai->formatted_tgl_lahir;
        $karir->agama = $pegawai->agama;
        $karir->pendidikan = $pegawai->pendidikan;
        $karir->jurusan = $pegawai->jurusan;
        $karir->pend_akhir = $pegawai->pend_akhir;
        $karir->institusi = $pegawai->institusi;
        $karir->tgl_masuk = $pegawai->formatted_tgl_masuk;
        $karir->masa_kerja = $pegawai->masa_kerja;

        foreach ($pegawai->riwayat as $key => $value) {
            $pegawai->riwayat[$key]->nik == ($pegawai->riwayat[$key + 1]->nik ?? null) ? $pegawai->riwayat[$key]->ma_sls = $pegawai->riwayat[$key + 1]->ma_tmt : $pegawai->riwayat[$key]->ma_sls = null;
            if($value->poscode) {
                if(in_array($value->unitkerja, $unitkerja_eksternal)) {
                    $data = [
                        'nama_jabatan' => implode(" ", array_unique([
                            $value->posisi->jobtitle,
                            $value->posisi->postitle,
                            $value->posisi->regu,
                            $value->posisi->seksi,
                            $value->posisi->bagian,
                        ])),
                        'nama_unitkerja' => $value->posisi->departemen ?? '-',
                        'tgl_mulai' => $pegawai->riwayat[$key]->formatted_ma_tmt,
                        'tgl_selesai' => $pegawai->riwayat[$key]->formatted_ma_sls,
                    ];

                    if((end($karir_eksternal)['nama_jabatan'] ?? null) == $data['nama_jabatan']) {
                        $last_key = key($karir_eksternal);
                        $karir_eksternal[$last_key]['tgl_selesai'] = $data['tgl_selesai'];
                        reset($karir_eksternal);
                        continue;
                    }

                    $karir_eksternal[] = $data;
                // jika poscode kosong
                } else {
                    $data = [
                        'nama_jabatan' => implode(" ", array_unique([
                            $value->posisi->jobtitle,
                            $value->posisi->postitle,
                            $value->posisi->regu,
                            $value->posisi->seksi,
                            $value->posisi->bagian,
                        ])),
                        'nama_unitkerja' => $value->posisi->departemen ?? '-',
                        'tgl_mulai' => $pegawai->riwayat[$key]->formatted_ma_tmt,
                        'tgl_selesai' => $pegawai->riwayat[$key]->formatted_ma_sls,
                    ];

                    if((end($karir_internal)['nama_jabatan'] ?? null) == $data['nama_jabatan']) {
                        $last_key = key($karir_internal);
                        $karir_internal[$last_key]['tgl_selesai'] = $data['tgl_selesai'];
                        reset($karir_internal);
                        continue;
                    }

                    $karir_internal[] = $data;
                }
            } else {
                if(in_array($value->unitkerja, $unitkerja_eksternal)) {
                    $data = [
                        'nama_jabatan' => implode(" ", array_unique([
                            $value->nm_jbt ?? '-',
                            $value->nm_pl,
                            $value->nm_ru,
                            $value->nm_si,
                            $value->nm_bag,
                        ])),
                        'nama_unitkerja' => $value->nm_dep ?? '-',
                        'tgl_mulai' => $pegawai->riwayat[$key]->formatted_ma_tmt,
                        'tgl_selesai' => $pegawai->riwayat[$key]->formatted_ma_sls,
                    ];

                    if((end($karir_eksternal)['nama_jabatan'] ?? null) == $data['nama_jabatan']) {
                        $last_key = key($karir_eksternal);
                        $karir_eksternal[$last_key]['tgl_selesai'] = $data['tgl_selesai'];
                        reset($karir_eksternal);
                        continue;
                    }

                    $karir_eksternal[] = $data;
                } else {
                    $data = [
                        'nama_jabatan' => implode(" ", array_unique([
                            $value->nm_jbt ?? '-',
                            $value->nm_pl,
                            $value->nm_ru,
                            $value->nm_si,
                            $value->nm_bag,
                        ])),
                        'nama_unitkerja' => $value->nm_dep ?? '-',
                        'tgl_mulai' => $pegawai->riwayat[$key]->formatted_ma_tmt,
                        'tgl_selesai' => $pegawai->riwayat[$key]->formatted_ma_sls,
                    ];

                    if((end($karir_internal)['nama_jabatan'] ?? null) == $data['nama_jabatan']) {
                        $last_key = key($karir_internal);
                        $karir_internal[$last_key]['tgl_selesai'] = $data['tgl_selesai'];
                        reset($karir_internal);
                        continue;
                    }

                    $karir_internal[] = $data;
                }
            }
        }

        foreach ($pegawai->pelatihanDN as $key => $value) {
            $pelatihanDN[] = [
                'jenis_pendidikan' => $value->course_title,
                'nama_tempat_penyelenggara' => $value->training_institution_name . ' ' . $value->training_location,
                'tgl_mulai' => $value->formatted_start_date,
                'tgl_selesai' => $value->formatted_end_date,
            ];
        }

        foreach ($pegawai->pelatihanLN as $key => $value) {
            $pelatihanLN[] = [
                'jenis_pendidikan' => $value->course_title,
                'nama_tempat_penyelenggara' => $value->training_institution_name . ' ' . $value->training_location,
                'tgl_mulai' => $value->formatted_start_date,
                'tgl_selesai' => $value->formatted_end_date,
            ];
        }

        $karir->karir_eksternal = $karir_eksternal;
        $karir->karir_internal = $karir_internal;
        $karir->pelatihanDN = $pelatihanDN;
        $karir->pelatihanLN = $pelatihanLN;

        return $karir;
    }

    public function find($nik_sap)
    {
        return Karir::find($nik_sap);
    }

    public function update($nik_sap, $request)
    {
        $karir_eksternal = [];
        $karir_internal = [];
        $pelatihanDN = [];
        $pelatihanLN = [];
        $pegawai = Karir::find($nik_sap);

        $pegawai->nama = $request->nama;
        $pegawai->nm_jabatan = $request->nm_jabatan;
        $pegawai->p_grade = $request->p_grade;
        $pegawai->tmp_lahir = $request->tmp_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->agama = $request->agama;
        $pegawai->pendidikan = $request->pendidikan;
        $pegawai->jurusan = $request->jurusan;
        $pegawai->pend_akhir = $request->pend_akhir;
        $pegawai->institusi = $request->institusi;
        $pegawai->tgl_masuk = $request->tgl_masuk;
        $pegawai->masa_kerja = $request->masa_kerja;

        if($request->has('nama_jabatan_eksternal')) {
            foreach ($request->nama_jabatan_eksternal as $key => $value) {
                $karir_eksternal[] = [
                    'nama_jabatan' => $request->nama_jabatan_eksternal[$key],
                    'nama_unitkerja' => $request->nama_unitkerja_eksternal[$key],
                    'tgl_mulai' => $request->tgl_mulai_eksternal[$key],
                    'tgl_selesai' => $request->tgl_selesai_eksternal[$key],
                ];
            }

        }

        if($request->has('nama_jabatan_internal')) {
            foreach ($request->nama_jabatan_internal as $key => $value) {
                $karir_internal[] = [
                    'nama_jabatan' => $request->nama_jabatan_internal[$key],
                    'nama_unitkerja' => $request->nama_unitkerja_internal[$key],
                    'tgl_mulai' => $request->tgl_mulai_internal[$key],
                    'tgl_selesai' => $request->tgl_selesai_internal[$key],
                ];
            }

        }

        if($request->has('jenis_pendidikan_dn')) {
            foreach ($request->jenis_pendidikan_dn as $key => $value) {
                $pelatihanDN[] = [
                    'jenis_pendidikan' => $request->jenis_pendidikan_dn[$key],
                    'nama_tempat_penyelenggara' => $request->nama_tempat_penyelenggara_dn[$key],
                    'tgl_mulai' => $request->tgl_mulai_dn[$key],
                    'tgl_selesai' => $request->tgl_selesai_dn[$key],
                ];
            }

        }

        if($request->has('jenis_pendidikan_ln')) {
            foreach ($request->jenis_pendidikan_ln as $key => $value) {
                $pelatihanLN[] = [
                    'jenis_pendidikan' => $request->jenis_pendidikan_ln[$key],
                    'nama_tempat_penyelenggara' => $request->nama_tempat_penyelenggara_ln[$key],
                    'tgl_mulai' => $request->tgl_mulai_ln[$key],
                    'tgl_selesai' => $request->tgl_selesai_ln[$key],
                ];
            }

        }

        $pegawai->karir_eksternal = $karir_eksternal;
        $pegawai->karir_internal = $karir_internal;
        $pegawai->pelatihanDN = $pelatihanDN;
        $pegawai->pelatihanLN = $pelatihanLN;

        $pegawai->update();
    }
}
