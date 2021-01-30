@extends('layouts.admin')

@section('title')
    Karir
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css')}}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('karir.index') }}">Karir</a></li>
@endsection

@section('header_title')
    Karir
@endsection

@section('header_right')
    <a class="btn btn-white tx-montserrat tx-semibold" data-toggle="collapse" href="#aturTabel" role="button" aria-expanded="false" aria-controls="aturTabel"><i data-feather="sliders" class="wd-10 mg-r-5"></i>Atur</a>
    <a href="{{ route('karir.generateKarir') }}" class="btn btn-primary tx-montserrat tx-semibold"><i class="fa fa-truck-loading wd-10 mg-r-10 tx-white"></i> Generate Data Karir</a>
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 mg-b-20">
        <div class="collapse mg-t-5 card bg-white" id="aturTabel">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <select class="form-control custom-select @error('dept') parsley-error @enderror" id="dept" name="dept" required>
                            <option value="" selected>Pilih Departemen</option>
                            @forelse ($dept as $row)
                                @if (old('dept') == $row->kode_dept)
                                    <option value="{{$row->kode_dept}}" selected>{{$row->departemen}}</option>
                                @else
                                    <option value="{{$row->kode_dept}}">{{$row->departemen}}</option>
                                @endif
                            @empty
                                <option value="">Tidak ada data</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control custom-select @error('p_grade') parsley-error @enderror" id="p_grade" name="p_grade" required>
                            <option value="" selected>Pilih Personal Grade</option>
                            @forelse ($p_grade as $row)
                                @if (old('p_grade') == $row->p_grade)
                                    <option value="{{$row->p_grade}}" selected>{{$row->p_grade}}</option>
                                @else
                                    <option value="{{$row->p_grade}}">{{$row->p_grade}}</option>
                                @endif
                            @empty
                                <option value="">Tidak ada data</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="query-button">
                        <i data-feather="search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 mg-b-10">
        @include('partials.messages')
        <div class="card bg-white">
            <div class="card-body p-0" style="overflow-x: auto !important;">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mg-0" id="tabledata">
                        <thead>
                            <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                                <th class="wd-10p" style="border-bottom: none !important">NIK</th>
                                <th class="wd-10p" style="border-bottom: none !important"><span class="mg-r-15">NIK SAP</span></th>
                                <th class="wd-25p" style="border-bottom: none !important"><span class="mg-r-15">Nama</span></th>
                                <th class="wd-10p" style="border-bottom: none !important"><span class="mg-r-15">P Grade</span></th>
                                <th class="wd-15p" style="border-bottom: none !important"><span class="mg-r-15">Jabatan</span></th>
                                <th class="wd-15p" style="border-bottom: none !important"><span class="mg-r-15">Posisi</span></th>
                                <th class="wd-15p" style="border-bottom: none !important"><span class="mg-r-15">Aksi</span></th>
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
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/i18n/id.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery.form.min.js') }}"></script>
    <script>
        var initial = {};
        initTable(initial);

        var datatable;
        var datatableUrl = `{{ route('karir.index') }}`;

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
                        data: 'nik',
                        name: 'nik',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'nik_sap',
                        name: 'nik_sap',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'p_grade',
                        name: 'p_grade',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'nm_jabatan',
                        name: 'nm_jabatan',
                    },
                    {
                        className: 'align-middle border-bottom',
                        data: 'postitle',
                        name: 'postitle',
                    },
                    {
                        className: 'border-bottom',
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            let show = `{{ route('karir.show') }}`;
                            let urlPdf = `{{ route('karir.generatePdf') }}`;
                            let urlExcel = `{{ route('karir.generateExcel') }}`;
                            let showUrl = show+`?nik_sap=${data.nik_sap}`;
                            let generatePdf = urlPdf+`?nik_sap=${data.nik_sap}`;
                            let generateExcel = urlExcel+`?nik_sap=${data.nik_sap}`;
                            let html = '';
                            if(data.is_processed) {
                                html += `<a class="btn btn-white" target="_blank" href="${showUrl}"><i class="fa fa-address-book"></i></a>`;
                                html += `<a class="btn btn-white" target="_blank" href="${generatePdf}"><i class="text-danger fa fa-file-pdf"></i></a>`;
                                html += `<a class="btn btn-white" target="_blank" href="${generateExcel}"><i class="text-success fa fa-file-excel"></i></a>`;
                            }
                            return html;
                        }
                    },
                ],
            });
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
        }

        $('#dept').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder :'Pilih Departemen',
            language: 'id-ID',
        });

        $('#p_grade').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder :'Pilih Personal Grade',
            language: 'id-ID',
        });

        $('#query-button').on('click', function(){
            let data = {};
            data['dept'] = $('#dept').val();
            data['p_grade'] = $('#p_grade').val();

            initTable(data);
        });
    </script>
@endsection