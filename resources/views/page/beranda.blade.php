@extends('layouts.admin')

@section('title')
    Beranda
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css')}}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
@endsection

@section('header_title')
    Beranda
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 mg-b-10">
        @include('partials.messages')
        <div class="card bg-white">
            <div class="card-body row">
                <div class="col-sm-12">
                    <h4 class="mg-b-10">Pencarian Cepat</h4>
                    <p>Lakukan pencarian berdasarkan NIK SAP.</p>
                    <div class="input-group">
                        <input class="form-control" type="text" name="nik_sap" id="nik_sap" placeholder="Masukkan NIK SAP">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" id="query-pegawai">
                                <i data-feather="search"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div id="card_pegawai">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="card bg-white">
            <div class="card-body row">
                <div class="col-sm-12">
                    <h4 class="mg-b-10">Pie Chart Pegawai</h4>
                    <p>Menunjukkan persebaran pegawai berdasarkan departemen dan personal grade.</p>
                </div>
                <div class="col-sm-4">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pegawai Aktif</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{ $count_pegawai }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pegawai Terfilter by Personal Grade</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1" id="count_filter_pegawai_p_grade"></h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pegawai Terfilter by Departemen</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1" id="count_filter_pegawai_departemen"></h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 input-group">
                    <select class="form-control custom-select @error('komp') parsley-error @enderror" id="komp" name="komp" required>
                        <option value="" selected>Pilih Kompartemen</option>
                        @forelse ($komp as $row)
                            @if (old('komp') == $row->kode_komp)
                                <option value="{{$row->kode_komp}}" selected>{{$row->kompartemen}}</option>
                            @else
                                <option value="{{$row->kode_komp}}">{{$row->kompartemen}}</option>
                            @endif
                        @empty
                            <option value="">Tidak ada data</option>
                        @endforelse
                    </select>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="query-button">
                            <i data-feather="search"></i> Cari
                        </button>
                    </div>
                </div>
                <div class="ht-300 ht-lg-500 col-sm-12 col-md-12 mg-b-10">
                    <canvas id="chartPiePgrade"></canvas>
                </div>
                <div class="ht-800 ht-lg-1000 col-sm-12 col-md-12 mg-b-10">
                    <canvas id="chartPieDepartemen"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('lib/select2/js/i18n/id.js') }}"></script>

    <script>
        var urlPegawai = "{{ route('api.pegawaiBeranda') }}";

        $('#query-pegawai').on('click', function(){
            $("#card_pegawai").html("");
            let nik_sap = $('#nik_sap').val();

            $.get(urlPegawai, {nik_sap: nik_sap}, function(response){
                let html = '';
                if(response) {
                    let show = `{{ route('karir.show') }}`;
                    let urlPdf = `{{ route('karir.generatePdf') }}`;
                    let urlExcel = `{{ route('karir.generateExcel') }}`;
                    let showUrl = show+`?nik_sap=${response.nik_sap}`;
                    let generatePdf = urlPdf+`?nik_sap=${response.nik_sap}`;
                    let generateExcel = urlExcel+`?nik_sap=${response.nik_sap}`;
                    html += `<div class="card flex-row flex-wrap">`
                    html += `<div class="card-header border-0">`
                    html += `<img src="http://km.petrokimia-gresik.com/karyawan/${response.nik}.jpg" alt="" height="200">`
                    html += `</div>`
                    html += `<div class="card-body px-2">`
                    html += `<h4 class="card-title">${response.nama}</h4>`
                    html += `<p class="card-text">${response.nm_jabatan}, ${response.postitle}</p>`
                    html += `<a class="btn btn-primary text-white" target="_blank" href="${showUrl}"><i class="text-white fa fa-address-book mg-r-10"></i>Lihat Detail</a>`
                    html += `<a class="btn btn-danger text-white" target="_blank" href="${generatePdf}"><i class="text-white fa fa-file-pdf mg-r-10"></i>Unduh PDF</a>`
                    html += `<a class="btn btn-success text-white" target="_blank" href="${generateExcel}"><i class="text-white fa fa-file-excel mg-r-10"></i>Unduh Excel</a>`
                    html += `</div>`
                    html += `<div class="w-100"></div>`
                    html += `</div>`
                } else {
                    html += `<div class="card flex-row flex-wrap">`
                    html += `<div class="card-header border-0">`
                    html += `<img src="https://placehold.it/200" alt="" height="200">`
                    html += `</div>`
                    html += `<div class="card-body px-2">`
                    html += `<h4 class="card-title">Nama (Data tidak ditemukan)</h4>`
                    html += `<p class="card-text">Jabatan, Posisi (Data tidak ditemukan)</p>`
                    html += `<a class="btn btn-primary text-white" href="#"><i class="text-white fa fa-address-book mg-r-10"></i>Lihat Detail</a>`
                    html += `<a class="btn btn-danger text-white" href="#"><i class="text-white fa fa-file-pdf mg-r-10"></i>Unduh PDF</a>`
                    html += `<a class="btn btn-success text-white" href="#"><i class="text-white fa fa-file-excel mg-r-10"></i>Unduh Excel</a>`
                    html += `</div>`
                    html += `<div class="w-100"></div>`
                    html += `</div>`
                }
                $("#card_pegawai").html(html);
            });
        });
        $('#query-button').on('click', function(){
            let data = {};
            data['kode_komp'] = $('#komp').val();

            dynamicPieChart1.destroy();
            dynamicPieChart2.destroy();
            initChart(data);
        });

        $('#komp').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder :'Pilih Kompartemen',
            language: 'id-ID',
        });

        var dynamicPieChart1;
        var dynamicPieChart2;
        var urlChart = "{{ route('api.chartBeranda') }}";

        var initialChart = {};
        initChart(initialChart);

        function initChart(chartData) {

            var responseDepartemen = new Array();
            var responsePegawaiByDepartemen = new Array();

            var responsePgrade = new Array();
            var responsePegawaiByPgrade = new Array();

            $.get(urlChart, {data: chartData}, function(response){
                var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                };

                response['pieChart1'].forEach(data => {
                    responseDepartemen.push(data.departemen);
                    responsePegawaiByDepartemen.push(data.pegawai_by_departemen);
                });

                response['pieChart2'].forEach(data => {
                    responsePgrade.push(data.p_grade);
                    responsePegawaiByPgrade.push(data.pegawai_by_p_grade);
                });

                var pieChart1Label = responseDepartemen;
                var pieChart2Label = responsePgrade;
                var pieChart1Data = responsePegawaiByDepartemen;
                var pieChart2Data = responsePegawaiByPgrade;
                var pieChart1BG = new Array();
                for (let index = 0; index < responseDepartemen.length; index++) {
                    pieChart1BG.push(dynamicColors());
                }
                var pieChart2BG = new Array();
                for (let index = 0; index < responsePegawaiByPgrade.length; index++) {
                    pieChart2BG.push(dynamicColors());
                }

                var dataDepartemen = {
                    labels: pieChart1Label,
                    datasets: [{
                        data: pieChart1Data,
                        backgroundColor: pieChart1BG
                    }]
                };

                var dataPgrade = {
                    labels: pieChart2Label,
                    datasets: [{
                        data: pieChart2Data,
                        backgroundColor: pieChart2BG
                    }]
                };

                var optionpie1 = {
                    title: {
                        display: true,
                        text: 'Persebaran Karyawan berdasarkan Departemen'
                    },
                    maintainAspectRatio: false,
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                };

                var optionpie2 = {
                    title: {
                        display: true,
                        text: 'Persebaran Karyawan berdasarkan Personal Grade'
                    },
                    maintainAspectRatio: false,
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                };

                var pieChart1 = document.getElementById('chartPieDepartemen');
                dynamicPieChart1 = new Chart(pieChart1, {
                    type: 'doughnut',
                    data: dataDepartemen,
                    options: optionpie1
                });

                var pieChart2 = document.getElementById('chartPiePgrade');
                dynamicPieChart2 = new Chart(pieChart2, {
                    type: 'doughnut',
                    data: dataPgrade,
                    options: optionpie2
                });

                $('#count_filter_pegawai_p_grade').text(response['count_filter_pegawai_p_grade']);
                $('#count_filter_pegawai_departemen').text(response['count_filter_pegawai_departemen']);
            });
        }
    </script>
@endsection