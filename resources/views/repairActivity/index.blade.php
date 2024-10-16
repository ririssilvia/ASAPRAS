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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Repair Activities</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('repairActivity.create') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-plus me-2"></i>Tambah Repair Activity
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive white-space-nowrap">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Report ID</th>
                                <th>Assigned To</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Remarks</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repairActivities as $index => $activity)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $activity->damageReport->description }}</td>
                                    <td>{{ $activity->assignedUser->name }}</td>
                                    <td>{{ $activity->start_date }}</td>
                                    <td>{{ $activity->end_date }}</td>
                                    <td>{{ $activity->remarks }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('repairActivity.edit', $activity->id) }}" class="btn btn-sm btn-icon btn-light">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('repairActivity.destroy', $activity->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon btn-light" onclick="return confirm('Are you sure you want to delete this activity?');">
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
