@extends('layouts.main')

@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Laporan Kerusakan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Laporan Kerusakan</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('damageReport.create') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-plus me-2"></i>Tambah Laporan
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row g-3">
            <div class="col-auto">
                <div class="position-relative">
                    <input class="form-control px-5" type="search" placeholder="Search laporan kerusakan">
                    <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                </div>
            </div>
            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <button class="btn btn-filter px-4"><i class="fadeIn animated bx bx-export me-2"></i>Export</button>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="product-table">
                    <div class="table-responsive white-space-nowrap">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Fasilitas</th>
                                    <th>Dilaporkan Oleh</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    {{-- <th>Tanggal Laporan</th> --}}
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($damageReports as $index => $report)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $report->facility->name }}</td>
                                        <td>{{ $report->reportedBy->name }}</td>
                                        <td>{{ $report->description }}</td>
                                        <td>
                                            <div class="product-box">
                                                @if($report->image_url)
                                                    <img src="{{ url(str_replace('public', 'storage', $report->image_url)) }}"
                                                         class="rounded-circle" width="50" height="50" alt="Gambar">
                                                    {{-- <a href="{{ asset($report->image_url) }}" target="_blank">Lihat Gambar</a> --}}
                                                @else
                                                    <img src="{{ url('assets/images/illustrations/tools.png') }}" class="rounded-circle" width="50" height="50" alt="Tidak Ada Gambar">
                                                @endif
                                            </div>
                                        </td>
                                        {{-- <td>{{ $report->report_date }}</td> --}}
                                        <td>
                                            <span class="badge {{ $report->status == 'selesai' ? 'bg-success' : ($report->status == 'dalam_perbaikan' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('damageReport.edit', $report->id) }}" class="btn btn-sm btn-icon btn-light">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <form action="{{ route('damageReport.destroy', $report->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-light" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
