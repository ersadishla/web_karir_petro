@extends('layouts.admin')

@section('title')
    Import
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Pegawai</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('pegawai.upload') }}">Import</a></li>
@endsection

@section('header_title')
    Import
@endsection

@section('header_right')
    <a href="#confirm" data-toggle="modal" data-animation="effect-scale" class="btn btn-danger tx-montserrat tx-semibold text-white">Hapus Data</a>
    <a href="{{ route('pegawai.index') }}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 mg-b-10">
        @include('partials.messages')
        <div class="card bg-white">
            <div class="card-body">
                <form action="{{ route('pegawai.upload.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="excelfile" id="excelfile" accept=".xls,.xlsx,.xlsm">
                            <label class="custom-file-label" for="excelfile">Unggah berkas</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary tx-montserrat tx-semibold float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade effect-scale" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14 bg-white">
                <form action="{{ route('pegawai.truncate') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="text-danger d-flex align-items-center justify-content-center mg-y-10">
                            <i class="fas fa-exclamation-circle fa-8x"></i>
                        </div>
                        <h5 class="tx-montserrat tx-medium">Apakah anda yakin ingin menghapus seluruh data ini?</h5>
                        <span>Tindakan ini tidak bisa dibatalkan</span>
                    </div>
                    <div class="modal-footer bd-t-0">
                        <a href="#" data-toggle="modal" data-animation="effect-scale" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary tx-montserrat tx-semibold submit-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery.form.min.js') }}"></script>
@endsection