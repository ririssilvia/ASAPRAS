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
                        <li class="breadcrumb-item active" aria-current="page">{{ $mode }} User</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('users.index') }}" class="btn btn-primary px-4">
                        <i class="fadeIn animated bx bx-left-arrow-alt me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">{{ $mode }} User</h5>
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
                                <span class="input-group-text"><i class="material-icons-outlined fs-5">person</i></span>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" value="{{ old('name', $user->name ?? '') }}" required>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="material-icons-outlined fs-5">mail</i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" value="{{ old('email', $user->email ?? '') }}" required>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text"><i class="material-icons-outlined fs-5">lock</i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="{{ old('password') }}" {{ $mode == 'Create' ? 'required' : '' }}>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Role ID -->
                    <div class="row mb-3">
                        <label for="role_id" class="col-sm-3 col-form-label">Role ID</label>
                        <div class="col-sm-9">
                            <select id="role_id" name="role_id" class="form-select" required>
                                <option value="">Select Role</option>
                                <option value="1" {{ old('role_id', $user->role_id ?? '') == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('role_id', $user->role_id ?? '') == 2 ? 'selected' : '' }}>User</option>
                                <option value="2" {{ old('role_id', $user->role_id ?? '') == 5 ? 'selected' : '' }}>Teknisi</option>
                            </select>
                            @error('role_id')
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
