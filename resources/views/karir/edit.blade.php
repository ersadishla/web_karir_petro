@extends('layouts.admin')

@section('title')
    Sunting Karir
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('karir.index') }}">Karir</a></li>
    <li class="breadcrumb-item"><a href="{{ route('karir.show', ['nik_sap' => $pegawai->nik_sap]) }}">Detail Karir</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('karir.edit', ['nik_sap' => $pegawai->nik_sap]) }}">Sunting Karir</a></li>
@endsection

@section('header_title')
    Sunting Karir
@endsection

@section('header_right')
    <a href="{{ route('karir.show', ['nik_sap' => $pegawai->nik_sap]) }}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 mg-b-10">
        @include('partials.messages')
        <div class="card bg-white">
            <div class="card-body pd-l-0 pd-r-0 pd-b-0 pd-t-10">
                <ul class="nav nav-line" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mg-l-20 active" id="data_diri" data-toggle="tab" href="#data_diri-tab" role="tab" aria-controls="data_diri-tab" aria-selected="true">Data Diri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="riwayat_jabatan" data-toggle="tab" href="#riwayat_jabatan-tab" role="tab" aria-controls="riwayat_jabatan-tab" aria-selected="false">Riwayat Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="diklat" data-toggle="tab" href="#diklat-tab" role="tab" aria-controls="diklat-tab" aria-selected="false">Pendidikan & Pelatihan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('karir.update') }}" method="post">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="data_diri-tab" role="tabpanel" aria-labelledby="data_diri">
                            <div class="form-group">
                                <label for="nik" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">NIK</label>
                                <input type="text" id="nik" name="nik" class="form-control" placeholder="" value="{{ $pegawai->nik }}" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="nik_sap" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">NIK SAP</label>
                                <input type="text" id="nik_sap" name="nik_sap" class="form-control" placeholder="" value="{{ $pegawai->nik_sap }}" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="" value="{{ $pegawai->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nm_jabatan" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jabatan</label>
                                <input type="text" id="nm_jabatan" name="nm_jabatan" class="form-control" placeholder="" value="{{ $pegawai->nm_jabatan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="p_grade" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Personal Grade</label>
                                <input type="text" id="p_grade" name="p_grade" class="form-control" placeholder="" value="{{ $pegawai->p_grade }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tmp_lahir" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tempat Lahir</label>
                                <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control" placeholder="" value="{{ $pegawai->tmp_lahir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Lahir</label>
                                <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="" value="{{ $pegawai->tgl_lahir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="agama" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Agama</label>
                                <input type="text" id="agama" name="agama" class="form-control" placeholder="" value="{{ $pegawai->agama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendidikan</label>
                                <input type="text" id="pendidikan" name="pendidikan" class="form-control" placeholder="" value="{{ $pegawai->pendidikan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jurusan" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jurusan</label>
                                <input type="text" id="jurusan" name="jurusan" class="form-control" placeholder="" value="{{ $pegawai->jurusan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pend_akhir" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendidikan Akhir</label>
                                <input type="text" id="pend_akhir" name="pend_akhir" class="form-control" placeholder="" value="{{ $pegawai->pend_akhir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="institusi" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Institusi</label>
                                <input type="text" id="institusi" name="institusi" class="form-control" placeholder="" value="{{ $pegawai->institusi }}" required>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="riwayat_jabatan-tab" role="tabpanel" aria-labelledby="riwayat_jabatan">
                            <div class="form-group">
                                <label for="tgl_masuk" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Masuk</label>
                                <input type="text" id="tgl_masuk" name="tgl_masuk" class="form-control" placeholder="" value="{{ $pegawai->tgl_masuk }}" required>
                            </div>
                            <div class="form-group">
                                <label for="masa_kerja" class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Masa Kerja</label>
                                <input type="text" id="masa_kerja" name="masa_kerja" class="form-control" placeholder="" value="{{ $pegawai->masa_kerja }}" required>
                            </div>
                            <p class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Mutasi Jabatan (Struktural/Fungsional)</p>
                            <p class="tx-medium tx-13 justify-content-center align-self-center">Di dalam PT Petrokimia Gresik</p>
                            @if (count($pegawai->karir_internal) > 0)
                                @foreach ($pegawai->karir_internal as $row)
                                <div class="karir_internal">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Jabatan</span>
                                        </div>
                                        <input type="text" name="nama_jabatan_internal[]" class="form-control nama_jabatan_internal" placeholder="" value="{{ $row['nama_jabatan'] }}">
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="nama_unitkerja_internal[]" class="form-control nama_unitkerja_internal" placeholder="" value="{{ $row['nama_unitkerja'] }}">
                                        <input type="text" name="tgl_mulai_internal[]" class="form-control tgl_mulai_internal" placeholder="" value="{{ $row['tgl_mulai'] }}">
                                        <input type="text" name="tgl_selesai_internal[]" class="form-control tgl_selesai_internal" placeholder="" value="{{ $row['tgl_selesai'] }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-karir_internal">Hapus</button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                @endforeach
                            @endif
                            <div id="karir_internal-baru">
                            </div>
                            <button id="tambah-karir_internal" type="button" class="btn btn-primary btn-sm tx-montserrat tx-semibold"><i data-feather="plus"></i>Tambah Karir Internal</button>
                            <hr>
                            <p class="tx-medium tx-13">Di luar PT Petrokimia Gresik</p>
                            @if (count($pegawai->karir_eksternal) > 0)
                                @foreach ($pegawai->karir_eksternal as $row)
                                    <div class="karir_eksternal">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Jabatan</span>
                                            </div>
                                            <input type="text" name="nama_jabatan_eksternal[]" class="form-control nama_jabatan_eksternal" placeholder="" value="{{ $row['nama_jabatan'] }}">
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="nama_unitkerja_eksternal[]" class="form-control nama_unitkerja_eksternal" placeholder="" value="{{ $row['nama_unitkerja'] }}">
                                            <input type="text" name="tgl_mulai_eksternal[]" class="form-control tgl_mulai_eksternal" placeholder="" value="{{ $row['tgl_mulai'] }}">
                                            <input type="text" name="tgl_selesai_eksternal[]" class="form-control tgl_selesai_eksternal" placeholder="" value="{{ $row['tgl_selesai'] }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-karir_eksternal">Hapus</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                            <div id="karir_eksternal-baru">
                            </div>
                            <button id="tambah-karir_eksternal" type="button" class="btn btn-primary btn-sm tx-montserrat tx-semibold"><i data-feather="plus"></i>Tambah Karir Eksternal</button>
                            <hr>
                        </div>
                        <div class="tab-pane fade" id="diklat-tab" role="tabpanel" aria-labelledby="diklat">
                            <p class="tx-medium tx-13">Dalam Negeri</p>
                            @if (count($pegawai->pelatihanDN) > 0)
                                @foreach ($pegawai->pelatihanDN as $row)
                                    <div class="pelatihan_dn">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Pelatihan</span>
                                            </div>
                                            <input type="text" name="jenis_pendidikan_dn[]" class="form-control jenis_pendidikan_dn" placeholder="" value="{{ $row['jenis_pendidikan'] }}">
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="nama_tempat_penyelenggara_dn[]" class="form-control nama_tempat_penyelenggara_dn" placeholder="" value="{{ $row['nama_tempat_penyelenggara'] }}">
                                            <input type="text" name="tgl_mulai_dn[]" class="form-control tgl_mulai_dn" placeholder="" value="{{ $row['tgl_mulai'] }}">
                                            <input type="text" name="tgl_selesai_dn[]" class="form-control tgl_selesai_dn" placeholder="" value="{{ $row['tgl_selesai'] }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-pelatihan_dn">Hapus</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                            <div id="pelatihan_dn-baru">
                            </div>
                            <button id="tambah-pelatihan_dn" type="button" class="btn btn-primary btn-sm tx-montserrat tx-semibold"><i data-feather="plus"></i>Tambah Pelatihan Dalam Negeri</button>
                            <hr>
                            <p class="tx-medium tx-13">Luar Negeri</p>
                            @if (count($pegawai->pelatihanLN) > 0)
                                @foreach ($pegawai->pelatihanLN as $row)
                                    <div class="pelatihan_ln">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Pelatihan</span>
                                            </div>
                                            <input type="text" name="jenis_pendidikan_ln[]" class="form-control jenis_pendidikan_ln" placeholder="" value="{{ $row['jenis_pendidikan'] }}">
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="nama_tempat_penyelenggara_ln[]" class="form-control nama_tempat_penyelenggara_ln" placeholder="" value="{{ $row['nama_tempat_penyelenggara'] }}">
                                            <input type="text" name="tgl_mulai_ln[]" class="form-control tgl_mulai_ln" placeholder="" value="{{ $row['tgl_mulai'] }}">
                                            <input type="text" name="tgl_selesai_ln[]" class="form-control tgl_selesai_ln" placeholder="" value="{{ $row['tgl_selesai'] }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-pelatihan_ln">Hapus</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                            <div id="pelatihan_ln-baru">
                            </div>
                            <button id="tambah-pelatihan_ln" type="button" class="btn btn-primary btn-sm tx-montserrat tx-semibold"><i data-feather="plus"></i>Tambah Pelatihan Luar Negeri</button>
                            <hr>
                        </div>
                        <button type="submit" class="btn btn-primary tx-montserrat tx-semibold float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#tambah-karir_internal").click(function () {
            let html = '';
            html += `<div class="karir_internal">`;
            html += `<div class="input-group">`;
            html += `<div class="input-group-prepend">`;
            html += `<span class="input-group-text">Jabatan</span>`;
            html += `</div>`;
            html += `<input type="text" name="nama_jabatan_internal[]" class="form-control nama_jabatan_internal" placeholder="Nama Jabatan" autocomplete="off">`;
            html += `</div>`;
            html += `<div class="input-group">`;
            html += `<input type="text" name="nama_unitkerja_internal[]" class="form-control nama_unitkerja_internal" placeholder="Nama Unit Kerja" autocomplete="off">`;
            html += `<input type="text" name="tgl_mulai_internal[]" class="form-control tgl_mulai_internal" placeholder="Tanggal mulai" autocomplete="off">`;
            html += `<input type="text" name="tgl_selesai_internal[]" class="form-control tgl_selesai_internal" placeholder="Tanggal selesai" autocomplete="off">`;
            html += `<div class="input-group-append">`;
            html += `<button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-karir_internal">Hapus</button>`;
            html += `</div>`;
            html += `</div>`;
            html += `<hr>`;
            html += `</div>`;

            $('#karir_internal-baru').append(html);
        });

        $(document).on("click", ".hapus-karir_internal", function () {
            console.log(this);
            $(this).closest('.karir_internal').remove();
        });

        $("#tambah-karir_eksternal").click(function () {
            let html = '';
            html += `<div class="karir_eksternal">`;
            html += `<div class="input-group">`;
            html += `<div class="input-group-prepend">`;
            html += `<span class="input-group-text">Jabatan</span>`;
            html += `</div>`;
            html += `<input type="text" name="nama_jabatan_eksternal[]" class="form-control nama_jabatan_eksternal" placeholder="Nama Jabatan" autocomplete="off">`;
            html += `</div>`;
            html += `<div class="input-group">`;
            html += `<input type="text" name="nama_unitkerja_eksternal[]" class="form-control nama_unitkerja_eksternal" placeholder="Nama Unit Kerja" autocomplete="off">`;
            html += `<input type="text" name="tgl_mulai_eksternal[]" class="form-control tgl_mulai_eksternal" placeholder="Tanggal mulai" autocomplete="off">`;
            html += `<input type="text" name="tgl_selesai_eksternal[]" class="form-control tgl_selesai_eksternal" placeholder="Tanggal selesai" autocomplete="off">`;
            html += `<div class="input-group-append">`;
            html += `<button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-karir_eksternal">Hapus</button>`;
            html += `</div>`;
            html += `</div>`;
            html += `<hr>`;
            html += `</div>`;

            $('#karir_eksternal-baru').append(html);
        });

        $(document).on("click", ".hapus-karir_eksternal", function () {
            console.log(this);
            $(this).closest('.karir_eksternal').remove();
        });

        $("#tambah-pelatihan_dn").click(function () {
            let html = '';
            html += `<div class="pelatihan_dn">`;
            html += `<div class="input-group">`;
            html += `<div class="input-group-prepend">`;
            html += `<span class="input-group-text">Pelatihan</span>`;
            html += `</div>`;
            html += `<input type="text" name="jenis_pendidikan_dn[]" class="form-control jenis_pendidikan_dn" placeholder="Jenis Pendidikan" autocomplete="off">`;
            html += `</div>`;
            html += `<div class="input-group">`;
            html += `<input type="text" name="nama_tempat_penyelenggara_dn[]" class="form-control nama_tempat_penyelenggara_dn" placeholder="Nama/Tempat Penyelenggara" autocomplete="off">`;
            html += `<input type="text" name="tgl_mulai_dn[]" class="form-control tgl_mulai_dn" placeholder="Tanggal mulai" autocomplete="off">`;
            html += `<input type="text" name="tgl_selesai_dn[]" class="form-control tgl_selesai_dn" placeholder="Tanggal selesai" autocomplete="off">`;
            html += `<div class="input-group-append">`;
            html += `<button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-pelatihan_dn">Hapus</button>`;
            html += `</div>`;
            html += `</div>`;
            html += `<hr>`;
            html += `</div>`;

            $('#pelatihan_dn-baru').append(html);
        });

        $(document).on("click", ".hapus-pelatihan_dn", function () {
            console.log(this);
            $(this).closest('.pelatihan_dn').remove();
        });

        $("#tambah-pelatihan_ln").click(function () {
            let html = '';
            html += `<div class="pelatihan_ln">`;
            html += `<div class="input-group">`;
            html += `<div class="input-group-prepend">`;
            html += `<span class="input-group-text">Pelatihan</span>`;
            html += `</div>`;
            html += `<input type="text" name="jenis_pendidikan_ln[]" class="form-control jenis_pendidikan_ln" placeholder="Jenis Pendidikan" autocomplete="off">`;
            html += `</div>`;
            html += `<div class="input-group">`;
            html += `<input type="text" name="nama_tempat_penyelenggara_ln[]" class="form-control nama_tempat_penyelenggara_ln" placeholder="Nama/Tempat Penyelenggara" autocomplete="off">`;
            html += `<input type="text" name="tgl_mulai_ln[]" class="form-control tgl_mulai_ln" placeholder="Tanggal mulai" autocomplete="off">`;
            html += `<input type="text" name="tgl_selesai_ln[]" class="form-control tgl_selesai_ln" placeholder="Tanggal selesai" autocomplete="off">`;
            html += `<div class="input-group-append">`;
            html += `<button type="button" class="btn btn-danger tx-montserrat tx-semibold hapus-pelatihan_ln">Hapus</button>`;
            html += `</div>`;
            html += `</div>`;
            html += `<hr>`;
            html += `</div>`;

            $('#pelatihan_ln-baru').append(html);
        });

        $(document).on("click", ".hapus-pelatihan_ln", function () {
            console.log(this);
            $(this).closest('.pelatihan_ln').remove();
        });
    </script>
@endsection