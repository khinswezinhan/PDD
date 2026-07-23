@extends('components.admin-layout')
@section('content')
    <div class="container py-2" style="max-width: 500px;">

        <div class="mb-3">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">Create Admin</h4>
        </div>

        <div class="card border shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="form-control py-2.5 rounded-2 shadow-sm @error('name') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label for="role_id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Role
                    </label>
                    <select name="role_id" id="role_id"
                        class="form-select py-2.5 rounded-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                        style="font-size: 0.95rem; border-color: #fdba74;" required>
                        <option value="">--Select a role--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="form-control py-2.5 rounded-2 shadow-sm @error('email') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">

                    @error('email')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="form-control py-2.5 rounded-2 shadow-sm @error('password') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="confirmpassword" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Confirm Password
                    </label>
                    <input type="password" name="confirmpassword" id="confirmpassword" required
                        class="form-control py-2.5 rounded-2 shadow-sm @error('confirmpassword') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">
                </div>

                {{-- Status --}}
                <div class="form-group mb-3">
                    <label for="status" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Status
                    </label>

                    <select name="status" id="status"
                        class="form-select py-2.5 rounded-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                        style="font-size: 0.95rem; border-color: #fdba74;">
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    @error('status')
                        <span class="text-danger text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Form Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-2">
                    <a href="{{ route('admin.users.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        Cancel
                    </a>

                    <button type="submit"
                        class="btn text-white px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm"
                        style="background-color: #f97316; border-color: #f97316;">
                        Create
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
