<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Riwayat Hidup</title>

        <style>
            .bg {
                top: 0cm;
                right: 0cm;
                bottom: 0cm;
                left: 0cm;
                position: absolute;
                z-index: -1000;
                max-width: 186mm;
                /* max-height: 297mm; */
            }

            .table-bordered {
                padding: 0.3em;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .table-header {
                height: 2em;
            }

            .text-center {
                text-align: center;
            }

            .align-center {
                align-content: center;
                align-items: center;
            }

            table {
                width: 100%;
                margin-top: 1em;
                margin-bottom: 1em;
                margin-left: 1em;
            }

            body {
                max-width: 70vw;
                margin: auto;
                font-size: 10pt;
            }

            td {
                vertical-align: middle;
            }
        </style>
    </head>

    <body>

        <img class="bg" src="<?= asset('assets/img/bg-cv-polos.jpg') ?>">

        <div style="position: relative; top: 0.1in; margin: auto 2.5%; text-align: right">
            <img src="http://km.petrokimia-gresik.com/karyawan/{{$pegawai->nik}}.jpg" alt="" width="100">
        </div>

        <div style="position: relative; top: 0.4in; margin: auto 5%">
            <h3>I. DATA PRIBADI</h3>
            <table>
                <tr>
                    <td style="width: 30%;">
                        <span>1. Nama Lengkap</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span style="text-transform: uppercase;"><?= $pegawai->nama ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                    </td>
                    <td>
                        <span><?= $pegawai->nik ?> / <?= $pegawai->nik_sap ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <span>2. Jabatan</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->nm_jabatan ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <span>3. Grade</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->p_grade ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <span>4. Tempat/Tanggal Lahir</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->tmp_lahir ?> / <?= $pegawai->tgl_lahir ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <span>5. Agama</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->agama ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <span>6. Dasar Penerimaan</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->pendidikan ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <span>7. Pendidikan Akhir</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->jurusan ?> - <?= $pegawai->pend_akhir ?> - <?= $pegawai->institusi ?></span>
                    </td>
                </tr>
            </table>
            <h3>II. RIWAYAT PEKERJAAN</h3>
            <table>
                <tr>
                    <td style="width: 45%;">
                        <span>1. Tanggal mulai bekerja</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->tgl_masuk ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 45%;">
                        <span>2. Jumlah masa kerja</span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                        <span><?= $pegawai->masa_kerja ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 45%;">
                        <span>3. Mutasi Jabatan (Struktural/Fungsional) </span>
                        <span style="float: right">: </span>
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
            @if (count($pegawai->karir_internal) > 0)
                <h4 style="margin-left: 0.5em; margin-bottom: 0;">A. Di dalam PT Petrokimia Gresik</h4>
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%" class="table-header table-bordered">No</th>
                            <th style="width: 55%" class="table-header table-bordered">Nama Jabatan</th>
                            <th style="width: 20%" class="table-header table-bordered">Nama Unit Kerja</th>
                            <th style="width: 20%" class="table-header table-bordered">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pegawai->karir_internal as $row)
                            <tr>
                                <td class="align-center text-center table-bordered">{{ $no++ }}</td>
                                <td class="align-center table-bordered">{{ $row['nama_jabatan'] }}</td>
                                <td class="align-center table-bordered">{{ $row['nama_unitkerja'] }}</td>
                                <td class="align-center text-centered table-bordered">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (count($pegawai->karir_eksternal) > 0)
                <h4 style="margin-left: 0.5em; margin-bottom: 0;">B. Di luar PT Petrokimia Gresik</h4>
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%" class="table-header table-bordered">No</th>
                            <th style="width: 55%" class="table-header table-bordered">Nama Jabatan</th>
                            <th style="width: 20%" class="table-header table-bordered">Nama Unit Kerja</th>
                            <th style="width: 20%" class="table-header table-bordered">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pegawai->karir_eksternal as $row)
                            <tr>
                                <td class="align-center text-center table-bordered">{{ $no++ }}</td>
                                <td class="align-center table-bordered">{{ $row['nama_jabatan'] }}</td>
                                <td class="align-center table-bordered">{{ $row['nama_unitkerja'] }}</td>
                                <td class="align-center text-centered table-bordered">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (count($pegawai->pelatihanDN) > 0 || count($pegawai->pelatihanLN) > 0)
                <h3>III. PENDIDIKAN DAN PELATIHAN  YANG TELAH DIIKUTI</h3>
                @if (count($pegawai->pelatihanDN) > 0)
                    <h4 style="margin-left: 0.5em; margin-bottom: 0;">A. Dalam Negeri</h4>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="table-header table-bordered">No</th>
                                <th style="width: 55%" class="table-header table-bordered">Jenis Pendidikan</th>
                                <th style="width: 20%" class="table-header table-bordered">Nama/Tempat Penyelenggara</th>
                                <th style="width: 20%" class="table-header table-bordered">Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pegawai->pelatihanDN as $row)
                                <tr>
                                    <td class="align-center text-center table-bordered">{{ $no++ }}</td>
                                    <td class="align-center table-bordered">{{ $row['jenis_pendidikan'] }}</td>
                                    <td class="align-center table-bordered">{{ $row['nama_tempat_penyelenggara'] }}</td>
                                    <td class="align-center text-centered table-bordered">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @if (count($pegawai->pelatihanLN) > 0)
                    <h4 style="margin-left: 0.5em; margin-bottom: 0;">B. Luar Negeri</h4>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="table-header table-bordered">No</th>
                                <th style="width: 55%" class="table-header table-bordered">Jenis Pendidikan</th>
                                <th style="width: 20%" class="table-header table-bordered">Nama/Tempat Penyelenggara</th>
                                <th style="width: 20%" class="table-header table-bordered">Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pegawai->pelatihanLN as $row)
                                <tr>
                                    <td class="align-center text-center table-bordered">{{ $no++ }}</td>
                                    <td class="align-center table-bordered">{{ $row['jenis_pendidikan'] }}</td>
                                    <td class="align-center table-bordered">{{ $row['nama_tempat_penyelenggara'] }}</td>
                                    <td class="align-center text-centered table-bordered">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </body>

</html>