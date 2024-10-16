@extends('layouts.main')

@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Facilities</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Facility List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('facility.create') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-plus me-2"></i>Add Facility
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card mt-4">
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-auto">
                        <div class="position-relative">
                            <input class="form-control px-5" type="search" placeholder="Search facilities">
                            <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <button class="btn btn-filter px-4"><i class="fadeIn animated bx bx-export me-2"></i>Export</button>
                    </div>
                </div>
                <div class="table-responsive white-space-nowrap">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th><input class="form-check-input" type="checkbox"></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $index => $facility)
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $facility->name }}</td>
                                    <td>{{ $facility->category }}</td>
                                    <td>{{ $facility->location }}</td>
                                    <td>
                                        <!-- Conditional status background color -->
                                        <span class="badge {{ $facility->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($facility->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('facility.edit', $facility->id) }}" class="btn btn-sm btn-icon btn-light">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('facility.destroy', $facility->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon btn-light" onclick="return confirm('Are you sure you want to delete this facility?');">
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
@endsection
