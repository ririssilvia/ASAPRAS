@extends('layouts.main')

@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Repair Activities</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $mode }} Repair Activity</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('repairActivity.index') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-left-arrow-alt me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">{{ $mode }} Repair Activity</h5>
                <form class="row g-3" action="{{ $action }}" method="POST">
                    @csrf
                    @if ($mode == 'Edit')
                        @method('PUT')
                    @endif

                    <!-- Report ID (Select) -->
                    <div class="row mb-3">
                        <label for="report_id" class="col-sm-3 col-form-label">Report ID</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="report_id" name="report_id" required>
                                <option value="">Pilih Laporan Kerusakan</option>
                                @foreach($damageReports as $report)
                                    <option value="{{ $report->id }}" {{ (old('report_id', $repairActivity->report_id ?? '') == $report->id) ? 'selected' : '' }}>
                                        {{ $report->description }} <!-- Menampilkan deskripsi sebagai pilihan -->
                                    </option>
                                @endforeach
                            </select>
                            @error('report_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Assigned To (Select) -->
                    <div class="row mb-3">
                        <label for="assigned_to" class="col-sm-3 col-form-label">Assigned To</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="assigned_to" name="assigned_to" required>
                                <option value="">Pilih Pengguna</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('assigned_to', $repairActivity->assigned_to ?? '') == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }} <!-- Menampilkan nama pengguna sebagai pilihan -->
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="row mb-3">
                        <label for="start_date" class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $repairActivity->start_date ?? '') }}" required>
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="row mb-3">
                        <label for="end_date" class="col-sm-3 col-form-label">End Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $repairActivity->end_date ?? '') }}">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="row mb-3">
                        <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ old('remarks', $repairActivity->remarks ?? '') }}</textarea>
                            @error('remarks')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit & Reset Buttons -->
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                                <button type="reset" class="btn btn-secondary px-4">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
