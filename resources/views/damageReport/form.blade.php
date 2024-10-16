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
                        <li class="breadcrumb-item active" aria-current="page">{{ $mode }} Laporan Kerusakan</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('damageReport.index') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-left-arrow-alt me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">{{ $mode }} Laporan Kerusakan</h5>
                <form class="row g-3" action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($mode == 'Edit')
                        @method('PUT')
                    @endif

                    <!-- Facility (Select Dropdown) -->
                    <div class="row mb-3">
                        <label for="facility_id" class="col-sm-3 col-form-label">Fasilitas</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="facility_id" name="facility_id" required>
                                <option value="">Pilih Fasilitas</option>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}" {{ (old('facility_id', $damageReport->facility_id ?? '') == $facility->id) ? 'selected' : '' }}>
                                        {{ $facility->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('facility_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="row mb-3">
                        <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="material-icons-outlined fs-5">description</i></span>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $damageReport->description ?? '') }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Reported By (Select Dropdown) -->
                    <div class="row mb-3">
                        <label for="reported_by" class="col-sm-3 col-form-label">Dilaporkan Oleh</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="reported_by" name="reported_by" required>
                                <option value="">Pilih Pelapor</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('reported_by', $damageReport->reported_by ?? '') == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('reported_by')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="row mb-3">
                        <label for="image_url" class="col-sm-3 col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div>
                                    <div class="mb-4 d-flex justify-content-center">
                                        <img id="selectedImage"
                                            src="{{ isset($damageReport) && $damageReport->image_url
                                                ? url($damageReport->image_url)
                                                : url('assets/images/illustrations/tools.png') }}"
                                            alt="example placeholder" class="img-thumbnail mt-1" width="300" />
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-primary btn-rounded">
                                            <label class="form-label text-white m-1" for="image_url">Pilih Gambar</label>
                                            <input type="file" accept="image/*" class="form-control d-none" id="image_url" name="image_url"
                                                onchange="displaySelectedImage(event, 'selectedImage')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('image_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if (auth()->user()->hasRole('teknisi'))
                    <!-- Status (Select Dropdown) -->
                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="laporan_diterima" {{ (old('status', $damageReport->status ?? '') == 'laporan_diterima') ? 'selected' : '' }}>Laporan Diterima</option>
                                <option value="dalam_perbaikan" {{ (old('status', $damageReport->status ?? '') == 'dalam_perbaikan') ? 'selected' : '' }}>Dalam Perbaikan</option>
                                <option value="selesai" {{ (old('status', $damageReport->status ?? '') == 'selesai') ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif
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
