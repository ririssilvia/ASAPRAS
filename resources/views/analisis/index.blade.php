@extends('layouts.main')

@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Grafik dan Analisa</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Analysis</li>
                    </ol>
                </nav>
            </div>
            @if (count($trafos) != 0)
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="fas fa-bolt"></i> Lihat Berdasarkan Trafo Lainnya
                    </button>
                    <button type="button"
                        class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end" style="max-height: 300px; overflow-y: auto;">
                        @foreach ($trafos as $item)
                            <a class="dropdown-item"
                                href="{{ url('analisis/' . $item->id_trafo) }}">{{ $item->garduInduk->nama . ' - ' . $item->nama_trafo }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        </div>
        <!--end breadcrumb-->

        @if (!$trafo)
            <div class="card rounded-4">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ url('assets/images/illustrations/no_data_found.png') }}" width="250" height="250" alt="no-data">
                        <h4 class="font-bold">No Data Found</h4>
                        <p>no data currently present at the moment....</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xxl-12 d-flex align-items-stretch">
                    <div class="card w-100 overflow-hidden rounded-4">
                        <div class="card-body position-relative p-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3 mb-5">
                                        <img src="{{ url('assets/images/illustrations/trafo.png') }}"
                                            class="rounded-circle bg-grd-info p-1" width="60" height="60" alt="user">
                                        <div class="">
                                            <p class="mb-0 fw-semibold">{{ $trafo->code_trafo }}</p>
                                            <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ $trafo->nama_trafo }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="">
                                            <h4 class="mb-1 fw-semibold d-flex align-content-center">
                                                {{ $trafo->garduInduk->ultg->nama_ultg }}
                                                <i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                            </h4>
                                            <p class="mb-3">ULTG</p>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="">
                                            <h4 class="mb-1 fw-semibold d-flex align-content-center">
                                                {{ $trafo->garduInduk->nama }}
                                                <i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                            </h4>
                                            <p class="mb-3">Gardu Induk</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="welcome-back-img pt-4">
                                        <img src="{{ url('assets/images/gallery/welcome-back-3.png') }} " height="180"
                                            alt="">
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            @if (count($logs) == 0)
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ url('assets/images/illustrations/no_data_found.png') }}" width="250" height="250" alt="no-data">
                            <h4 class="font-bold">No Data Found</h4>
                            <p>no data currently present at the moment....</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4">
                            <div class="card-header py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="parent-icon me-2">
                                            <i class="material-icons-outlined" style="font-size: 48px;">thermostat</i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Oil Temperature Indicator</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Time Filters">
                                            <button type="button" class="btn btn-outline-primary" onclick="filterSeries(oilChart, '15m')">15 Menit</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="filterSeries(oilChart, '1h')">1 Jam</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="filterSeries(oilChart, '7d')">7 Hari</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="filterSeries(oilChart, '1m')">1 Bulan</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="filterSeries(oilChart, '1y')">1 Tahun</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="oil_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4">
                            <div class="card-header py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="parent-icon me-2">
                                            <i class="material-icons-outlined" style="font-size: 48px;">thermostat</i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">HV Winding Temperature Indicator</h5>
                                        </div>
                                    </div>
                                    <div class="btn-group ms-auto" role="group" aria-label="Time Filters">
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(hvChart, '15m')">15 Menit</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(hvChart, '1h')">1 Jam</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(hvChart, '7d')">7 Hari</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(hvChart, '1m')">1 Bulan</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(hvChart, '1y')">1 Tahun</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="hv_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4">
                            <div class="card-header py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="parent-icon me-2">
                                            <i class="material-icons-outlined" style="font-size: 48px;">thermostat</i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">LV Winding Temperature Indicator</h5>
                                        </div>
                                    </div>
                                    <div class="btn-group ms-auto" role="group" aria-label="Time Filters">
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(lvChart, '15m')">15 Menit</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(lvChart, '1h')">1 Jam</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(lvChart, '7d')">7 Hari</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(lvChart, '1m')">1 Bulan</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="filterSeries(lvChart, '1y')">1 Tahun</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="lv_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-12 d-flex align-items-stretch">
                        <div class="card w-100 rounded-4">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-3">
                                    <div class="">
                                        <h5 class="mb-0">Data System Failure</h5>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <span class="material-icons-outlined fs-5">more_vert</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="order-search position-relative my-3">
                                    <input class="form-control rounded-5 px-5" type="text" placeholder="Search">
                                    <span
                                        class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Nama</th>
                                                <th>Oil Temp</th>
                                                <th>HV Winding Temp</th>
                                                <th>LV Winding Temp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($failureLog as $index => $item)
                                                <tr>
                                                    <td>{{ ($failureLog->currentPage() - 1) * $failureLog->perPage() + $index + 1 }}</td>
                                                    <td>{{ date("Y-m-d",strtotime($item->created_at)) }}</td>
                                                    <td>{{ date("H:i:s",strtotime($item->created_at)) }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->tmp_oil_ind }}</td>
                                                    <td>{{ $item->tmp_hv_ind }}</td>
                                                    <td>{{ $item->tmp_lv_ind }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $failureLog->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ url('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script>
        const logs = @json($logs);
        let oil_series = [];
        let hv_series = [];
        let lv_series = [];
        let categories = [];
        let oilChart, hvChart, lvChart;

        function filterSeries(chart, filter) {
            const now = new Date();
            let filteredData = [];

            switch(filter) {
                case '15m':
                    filteredData = logs.filter(log => (now - new Date(log.created_at)) <= 15 * 60 * 1000);
                    break;
                case '1h':
                    filteredData = logs.filter(log => (now - new Date(log.created_at)) <= 60 * 60 * 1000);
                    break;
                case '7d':
                    filteredData = logs.filter(log => (now - new Date(log.created_at)) <= 7 * 24 * 60 * 60 * 1000);
                    break;
                case '1m':
                    filteredData = logs.filter(log => (now - new Date(log.created_at)) <= 30 * 24 * 60 * 60 * 1000);
                    break;
                case '1y':
                    filteredData = logs.filter(log => (now - new Date(log.created_at)) <= 365 * 24 * 60 * 60 * 1000);
                    break;
                default:
                    filteredData = logs;
            }

            updateSeries(chart, filteredData);
        }

        function updateSeries(chart, data) {
            let series = [];
            categories = [];
            
            data.forEach(item => {
                series.push({
                    environment: item.suhu_daerah,
                    temperature: item.tmp_oil_ind,
                    average_temperature: item.tmp_oil_ind_average,
                });
                categories.push(item.created_at)
            });

            chart.updateSeries([{
                name: "Environment Temperature",
                data: series.map(item => item.environment)
            }, {
                name: "Temperature",
                data: series.map(item => item.temperature)
            }, {
                name: "Average Temperature",
                data: series.map(item => item.average_temperature)
            }]);
            chart.updateOptions({
                xaxis: {
                    categories: categories
                }
            });
        }

        // function formatDateTime(dateTime) {
        //     const date = new Date(dateTime);
        //     return `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}`;
        // }

        function setChart() {
            if (!logs || logs.length == 0) return

            logs.forEach(item => {
                oil_series.push({
                    environment: item.suhu_daerah,
                    temperature: item.tmp_oil_ind,
                    average_temperature: item.tmp_oil_ind_average,
                });
                hv_series.push({
                    environment: item.suhu_daerah,
                    temperature: item.tmp_hv_ind,
                    average_temperature: item.tmp_hv_ind_average,
                });
                lv_series.push({
                    environment: item.suhu_daerah,
                    temperature: item.tmp_lv_ind,
                    average_temperature: item.tmp_lv_ind_average,
                });
                categories.push(item.created_at)
            });

            const options = {
                chart: {
                    foreColor: "#9ba7b2",
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: true
                    },
                    toolbar: {
                        show: true,
                    },
                    dropShadow: {
                        enabled: !0,
                        top: 3,
                        left: 14,
                        blur: 4,
                        opacity: .12,
                        color: "#fc185a"
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        gradientToColors: ['#17ad37', '#7928ca', '#00c6fb'],
                        shadeIntensity: 1,
                        type: 'vertical',
                        opacityFrom: 1,
                        opacityTo: 1,
                    },
                },
                colors: ['#98ec2d', '#ff0080', '#005bea'],
                grid: {
                    show: true,
                    borderColor: 'rgba(0, 0, 0, 0.15)',
                    strokeDashArray: 4,
                },
                tooltip: {
                    theme: "dark",
                    x: {
                        formatter: function (value) {
                            return formatDateTime(value)
                        }
                    }
                },
                xaxis: {
                    categories: categories,
                    type: 'datetime'
                }
            };

            if (document.querySelector("#oil_chart")) {
                let oilOptions = Object.assign({
                    series: [{
                            name: "Environment Temperature",
                            data: oil_series.map(item => item.environment)
                        },
                        {
                            name: "Oil Temperature",
                            data: oil_series.map(item => item.temperature)
                        },
                        {
                            name: "Oil Temperature Average",
                            data: oil_series.map(item => item.average_temperature)
                        }
                    ]
                }, options)

                oilChart = new ApexCharts(document.querySelector("#oil_chart"), oilOptions);
                oilChart.render();
            }
            if (document.querySelector("#hv_chart")) {
                let hvOptions = Object.assign({
                    series: [{
                            name: "Environment Temperature",
                            data: hv_series.map(item => item.environment)
                        },
                        {
                            name: "HV Winding Temperature",
                            data: hv_series.map(item => item.temperature)
                        },
                        {
                            name: "HV Winding Temperature Average",
                            data: hv_series.map(item => item.average_temperature)
                        }
                    ]
                }, options)

                hvChart = new ApexCharts(document.querySelector("#hv_chart"), hvOptions);
                hvChart.render();
            }
            if (document.querySelector("#lv_chart")) {
                let lvOptions = Object.assign({
                    series: [{
                            name: "Environment Temperature",
                            data: lv_series.map(item => item.environment)
                        },
                        {
                            name: "LV Winding Temperature",
                            data: lv_series.map(item => item.temperature)
                        },
                        {
                            name: "LV Winding Temperature Average",
                            data: lv_series.map(item => item.average_temperature)
                        }
                    ]
                }, options)

                lvChart = new ApexCharts(document.querySelector("#lv_chart"), lvOptions);
                lvChart.render();
            }
        }

        $(window).on('load', function() {
            setChart()
        });
    </script>
@endpush
