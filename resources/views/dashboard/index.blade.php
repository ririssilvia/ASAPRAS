@extends('layouts.main')


@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Laporan Kerusakan</h5>
                        <p class="card-text">{{ $totalReports }}</p>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Dalam Proses</h5>
                        <p class="card-text">{{ $reportsInProgress }}</p>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Diterima</h5>
                        <p class="card-text">{{ $reportsReceived }}</p>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Selesai</h5>
                        <p class="card-text">{{ $reportsCompleted }}</p> <!-- Menampilkan jumlah laporan yang selesai -->
                    </div>
                </div>
            </div>
        </div>
        

    </div>
@endsection




