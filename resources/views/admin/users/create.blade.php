@extends('components.admin-layout')
@section('content')
    <div class="container py-5" style="max-width: 700px;">

        <div class="mb-4">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">Create Admin</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Input Field Group --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder=""
                        class="form-control py-2.5 rounded-2 @error('name') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="role_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    <select name="role_id" id="role_id"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                        <option value="">--Select a role--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder=""
                        class="form-control py-2.5 rounded-2 @error('email') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    @error('email')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Password
                    </label>
                    <input type="password" name="password" id="password" value="{{ old('password') }}" required
                        placeholder="" class="form-control py-2.5 rounded-2 @error('password') is-invalid @enderror"
                        style="font-size: 0.95rem;">
                </div>

                <div class="mb-4">
                    <label for="confirmpassword" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        Confirm Password
                    </label>
                    <input type="password" name="confirmpassword" id="confirmpassword" value="{{ old('confirmpassord') }}"
                        required placeholder=""
                        class="form-control py-2.5 rounded-2 @error('confirmpassword') is-invalid @enderror"
                        style="font-size: 0.95rem;">
                </div>

                <div class="form-group">
                    <label>Status:</label><br>

                    <input type="radio" name="status" value="active" id="active"
                        {{ old('status') == 'active' ? 'checked' : '' }}>
                    <label for="active">Active</label>

                    <input type="radio" name="status" value="inactive" id="inactive"
                        {{ old('status') == 'inactive' ? 'checked' : '' }}>
                    <label for="inactive">Inactive</label>

                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Form Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-4">
                    <a href="{{ route('admin.users.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        Cancle
                    </a>

                    <button type="submit"
                        class="btn btn-primary px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                        Create
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
