@extends('layouts.main')

@section('main-content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"></li>
                        <li class="breadcrumb-item active" aria-current="page">User List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('users.create') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-plus me-2"></i>Add User
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
                            <input class="form-control px-5" type="search" placeholder="Search users">
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
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name ?? 'No Role' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-icon btn-light">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            @if ($user->hasRole('user'))
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-light" onclick="return confirm('Are you sure you want to delete this user?');">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
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
