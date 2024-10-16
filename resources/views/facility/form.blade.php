@extends('layouts.main')

@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Facilities</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('facility.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $mode }} Facility</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('facility.index') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-left-arrow-alt me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">{{ $mode }} Facility</h5>
                <form class="row g-3" action="{{ $action }}" method="POST">
                    @csrf
                    @if ($mode == 'Edit')
                        @method('PUT')
                    @endif
                    <!-- Name -->
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <!-- Changed to appropriate icon for business/facility -->
                                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Facility Name" value="{{ old('name', $facility->name ?? '') }}" required>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="row mb-3">
                        <label for="category" class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <!-- Updated to category icon -->
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <select id="category" name="category" class="form-select" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}" {{ (old('category', $facility->category ?? '') == $category) ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="row mb-3">
                        <label for="location" class="col-sm-3 col-form-label">Location</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <!-- Updated to location icon -->
                                <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Location" value="{{ old('location', $facility->location ?? '') }}" required>
                            </div>
                            @error('location')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <!-- Updated to toggle icon for status -->
                                <span class="input-group-text"><i class="bx bx-toggle-left"></i></span>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" {{ (old('status', $facility->status ?? '') == $status) ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit & Reset Buttons -->
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
                                <button type="reset" class="btn btn-grd-royal px-4 reset">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
