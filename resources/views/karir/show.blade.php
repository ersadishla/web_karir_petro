@extends('layouts.admin')

@section('title')
    Detail Karir
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('karir.index') }}">Karir</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('karir.show', ['nik_sap' => $pegawai->nik_sap]) }}">Detail Karir</a></li>
@endsection

@section('header_title')
    Detail Karir
@endsection

@section('header_right')
    <a href="{{ route('karir.generateObject', ['nik_sap' => $pegawai->nik_sap]) }}" class="btn btn-primary btn-lg tx-montserrat tx-semibold"><i class="fa fa-sync-alt wd-10 mg-r-5 tx-white"></i> Restore Data</a>
    <a href="{{ route('karir.generatePdf', ['nik_sap' => $pegawai->nik_sap]) }}" class="btn btn-danger btn-lg tx-montserrat tx-semibold"><i class="fa fa-file-pdf wd-10 mg-r-5 tx-white"></i> Pdf</a>
    <a href="{{ route('karir.generateExcel', ['nik_sap' => $pegawai->nik_sap]) }}" class="btn btn-success btn-lg tx-montserrat tx-semibold"><i class="fa fa-file-excel wd-10 mg-r-5 tx-white"></i> Excel</a>
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 mg-b-10">
        @include('partials.messages')
        <div class="card bg-white">
            <div class="card-header">
                <div class="row row-xs">
                    <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <h5 class="tx-medium tx-montserrat mg-b-0">Data Pribadi</h5>
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 col-lg-2">
                        <a href="{{ route("karir.edit", ['nik_sap' => $pegawai->nik_sap]) }}" class="btn btn-white tx-montserrat tx-semibold float-right d-none d-lg-block"><i data-feather="edit" class="wd-10 mg-r-5"></i> Sunting</a>
                        <a href="{{ route("karir.edit", ['nik_sap' => $pegawai->nik_sap]) }}" class="btn btn-white btn-icon tx-montserrat tx-medium float-right d-lg-none"><i data-feather="edit"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-xs">
                    <div class="col-sm-12 d-lg-none">
                        <img src="http://km.petrokimia-gresik.com/karyawan/{{$pegawai->nik}}.jpg" alt="" width="150">
                    </div>
                    <div class="col-12 col-sm-12 col-lg-10">
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Nama Lengkap</span>
                        <p>{{ $pegawai->nama }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Nomor Induk Kepegawaian</span>
                        <p>{{ $pegawai->nik }} / {{ $pegawai->nik_sap }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Jabatan</span>
                        <p>{{ $pegawai->nm_jabatan }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Grade</span>
                        <p>{{ $pegawai->p_grade }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Tempat/Tanggal Lahir</span>
                        <p>{{ $pegawai->tmp_lahir }} / {{ $pegawai->tgl_lahir }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Agama</span>
                        <p>{{ $pegawai->agama }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Dasar Penerimaan</span>
                        <p>{{ $pegawai->pendidikan }}</p>
                        <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Pendidikan</span>
                        <p class="mg-b-0">{{ $pegawai->jurusan }} &bullet; {{ $pegawai->pend_akhir }} &bullet; {{ $pegawai->institusi }}</p>
                    </div>
                    <div class="col-lg-2 d-none d-lg-block">
                        <img src="http://km.petrokimia-gresik.com/karyawan/{{$pegawai->nik}}.jpg" alt="" width="150">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- col -->
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="card bg-white">
            <div class="card-header">
                <div class="row row-xs">
                    <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <h5 class="tx-medium tx-montserrat mg-b-0">Riwayat Jabatan</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Tanggal mulai bekerja</span>
                <p>{{ $pegawai->tgl_masuk }}</p>
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Jumlah masa kerja</span>
                <p>{{ $pegawai->masa_kerja }}</p>
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-semibold">Mutasi Jabatan (Struktural/Fungsional)</span>
                @if (count($pegawai->karir_internal) > 0)
                    <p class="tx-medium tx-15">Di dalam PT Petrokimia Gresik</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mg-b-0">
                            <thead>
                                <tr>
                                    <th class="wd-5p">No</th>
                                    <th class="wd-55p">Nama Jabatan</th>
                                    <th class="wd-20p">Nama Unit Kerja</th>
                                    <th class="wd-20p">Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pegawai->karir_internal as $row)
                                    <tr>
                                        <td class="align-middle text-center">{{ $no++ }}</td>
                                        <td class="align-middle">{{ $row['nama_jabatan'] }}</td>
                                        <td class="align-middle">{{ $row['nama_unitkerja'] }}</td>
                                        <td class="align-middle text-center">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <hr class="mg-t-20 mg-b-20">
                @if (count($pegawai->karir_eksternal) > 0)
                    <p class="tx-medium tx-15">Di luar PT Petrokimia Gresik</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mg-b-0">
                            <thead>
                                <tr>
                                    <th class="wd-5p">No</th>
                                    <th class="wd-55p">Nama Jabatan</th>
                                    <th class="wd-20p">Nama Unit Kerja</th>
                                    <th class="wd-20p">Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pegawai->karir_eksternal as $row)
                                    <tr>
                                        <td class="align-middle text-center">{{ $no++ }}</td>
                                        <td class="align-middle">{{ $row['nama_jabatan'] }}</td>
                                        <td class="align-middle">{{ $row['nama_unitkerja'] }}</td>
                                        <td class="align-middle text-center">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div><!-- col -->
    @if (count($pegawai->pelatihanDN) > 0 || count($pegawai->pelatihanLN) > 0)
        <div class="col-sm-12 col-lg-12 mg-b-10">
            <div class="card bg-white">
                <div class="card-header">
                    <div class="row row-xs">
                        <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                            <div class="d-flex align-items-center">
                            <h5 class="tx-medium tx-montserrat mg-b-0">Pendidikan & Pelatihan yang telah diikuti</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($pegawai->pelatihanDN) > 0)
                        <p class="tx-medium tx-15">Dalam Negeri</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mg-b-0">
                                <thead>
                                    <tr>
                                        <th class="wd-5p">No</th>
                                        <th class="wd-55p">Jenis Pendidikan</th>
                                        <th class="wd-20p">Nama/Tempat Penyelenggara</th>
                                        <th class="wd-20p">Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pegawai->pelatihanDN as $row)
                                        <tr>
                                            <td class="align-middle text-center">{{ $no++ }}</td>
                                            <td class="align-middle">{{ $row['jenis_pendidikan'] }}</td>
                                            <td class="align-middle">{{ $row['nama_tempat_penyelenggara'] }}</td>
                                            <td class="align-middle text-center">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <hr class="mg-t-20 mg-b-20">
                    @if (count($pegawai->pelatihanLN) > 0)
                        <p class="tx-medium tx-15">Luar Negeri</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mg-b-0">
                                <thead>
                                    <tr>
                                        <th class="wd-5p">No</th>
                                        <th class="wd-55p">Jenis Pendidikan</th>
                                        <th class="wd-20p">Nama/Tempat Penyelenggara</th>
                                        <th class="wd-20p">Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pegawai->pelatihanLN as $row)
                                        <tr>
                                            <td class="align-middle text-center">{{ $no++ }}</td>
                                            <td class="align-middle">{{ $row['jenis_pendidikan'] }}</td>
                                            <td class="align-middle">{{ $row['nama_tempat_penyelenggara'] }}</td>
                                            <td class="align-middle text-center">{{ $row['tgl_mulai'] ?? '' }} s.d. {{ $row['tgl_selesai'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- col -->
    @endif
@endsection