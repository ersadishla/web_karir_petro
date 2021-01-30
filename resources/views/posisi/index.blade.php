@extends('layouts.admin')

@section('title')
    Posisi
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('posisi.index') }}">Posisi</a></li>
@endsection

@section('header_title')
    Posisi
@endsection

@section('header_right')
    <a class="btn btn-primary tx-montserrat tx-semibold text-white" href="{{ route('posisi.download') }}"><i data-feather="download" class="mg-r-5"></i> Export</a>
    <a class="btn btn-primary tx-montserrat tx-semibold text-white" href="{{ route('posisi.upload') }}"><i data-feather="upload" class="mg-r-5"></i> Import</a>
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 mg-b-10">
        @include('partials.messages')
        <div class="card bg-white">
            <div class="card-body p-0" style="overflow-x: auto !important;">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mg-0" id="tabledata">
                        <thead>
                            <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                                <th class="wd-10p" style="border-bottom: none !important">Poscode</th>
                                <th class="wd-25p" style="border-bottom: none !important"><span class="mg-r-15">Nama</span></th>
                                <th class="wd-25p" style="border-bottom: none !important"><span class="mg-r-15">Jobtitle</span></th>
                                <th class="wd-25p" style="border-bottom: none !important"><span class="mg-r-15">Departemen</span></th>
                                <th class="wd-15p" style="border-bottom: none !important"><span class="mg-r-15">Orgcode</span></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery.form.min.js') }}"></script>
    <script>
        var initial = {};
        initTable(initial);

        var datatable;
        var datatableUrl = `{{ route('posisi.index') }}`;

        function initTable(datatableData) {
            datatable = $("#tabledata").DataTable({
                dom:    "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'rtr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                language: {
                    search: '',
                    searchPlaceholder:  "Cari...",
                    processing:         '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>',
                    lengthMenu:         '_MENU_ data/halaman',
                    emptyTable:         'Tidak ada data yang tersedia pada tabel ini',
                    zeroRecords:        'Tidak ditemukan data yang sesuai',
                    info:               'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                    infoEmpty:          'Menampilkan 0 sampai 0 dari 0 entri',
                    infoFiltered:       '(disaring dari _MAX_ entri keseluruhan)',
                    paginate: {
                        first: "<i class='fas fa-angle-double-left'></i>",
                        last: "<i class='fas fa-angle-double-right'></i>",
                        previous: "<i class='fas fa-angle-left'></i>",
                        next: "<i class='fas fa-angle-right'></i>"
                    },
                },
                pagingType:     'full_numbers',
                destroy:        true,
                searchDelay:    1000,
                processing:     true,
                serverSide:     true,
                order:          [[0, 'asc']],
                ajax: {
                    data: datatableData,
                    url: datatableUrl
                },
                columns: [
                    {
                        className: 'align-middle border-bottom',
                        data: 'poscode',
                        name: 'poscode',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'postitle',
                        name: 'postitle',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'jobtitle',
                        name: 'jobtitle',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'dep',
                        name: 'dep',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'orgcode',
                        name: 'orgcode',
                    },
                ],
            });
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
        }
    </script>
@endsection