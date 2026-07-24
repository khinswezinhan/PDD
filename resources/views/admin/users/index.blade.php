@extends('components.admin-layout')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-gray-800 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header Section --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Users List</h3>
            <a href="{{ route('admin.users.create') }}"
                class="btn text-white px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center gap-2 orange-btn">
                <span>Create User</span>
            </a>
        </div>

        {{-- Search & Filter Box --}}
        <div class="mb-5 bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <form action="{{ route('admin.users.index') }}" method="GET"
                style="display: flex !important; flex-direction: row !important; gap: 12px; align-items: center; width: 100%;">

                {{-- Search Input Container --}}
                <div style="position: relative; width: 288px;">
                    <span
                        style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; color: #9ca3af; pointer-events: none;">
                        <i class="fa-solid fa-magnifying-glass" style="font-size: 14px; line-height: 1;"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..."
                        style="padding-left: 36px !important; padding-right: 12px; height: 40px; font-size: 14px; width: 100%; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>

                {{-- Role Filter --}}
                <div style="width: 192px;">
                    <select name="role_id"
                        style="height: 40px; font-size: 14px; width: 100%; padding: 0 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="">All Roles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div style="display: flex; gap: 8px;">
                    <button type="submit"
                        style="height: 40px; font-size: 14px; padding: 0 16px; color: white; background-color: orange; border-radius: 8px; cursor: pointer;">
                        Search
                    </button>
                    @if (request()->filled('search') || request()->filled('role_id'))
                        <a href="{{ route('admin.users.index') }}"
                            style="height: 40px; font-size: 14px; padding: 0 16px; display: inline-flex; align-items: center; color: #374151; background-color: #f3f4f6; border-radius: 8px; text-decoration: none;">
                            Clear
                        </a>
                    @endif
                </div>

            </form>
        </div>

        {{-- Table Section --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom border-secondary-subtle">
                        <tr class="text-secondary text-uppercase fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">
                            <th scope="col" class="ps-4 py-3 text-center" style="width: 80px;">No</th>
                            <th scope="col" class="py-3 ps-3">Name</th>
                            <th scope="col" class="py-3 ps-3">Role</th>
                            <th scope="col" class="py-3 ps-3">Email</th>
                            <th scope="col" class="py-3 text-end pe-4" style="width: 240px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr class="border-bottom border-light">
                                {{-- No --}}
                                <td class="ps-4 py-3 text-center fw-normal text-muted" style="font-size: 0.9rem;">
                                    {{ $users->firstItem() + $index }}
                                </td>

                                {{-- Name --}}
                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary" style="font-size: 0.9rem;">
                                        {{ $user->name }}
                                    </span>
                                </td>

                                {{-- Role (ရောင်စုံ Badge ဖြုတ်ထားသည်) --}}
                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary" style="font-size: 0.9rem;">
                                        {{ $user->role?->role_name ?? 'No Role' }}
                                    </span>
                                </td>

                                {{-- Email --}}
                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary" style="font-size: 0.9rem;">
                                        {{ $user->email }}
                                    </span>
                                </td>

                                {{-- Action Buttons --}}
                                <td class="text-end pe-4 py-3">
                                    <div class="d-flex justify-content-end align-items-center gap-2">

                                        {{-- Edit Button --}}
                                        @if ($user->status === 'active')
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="text-warning fs-5 d-inline-block" title="Edit User">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <span class="text-secondary opacity-50 fs-5 d-inline-block cursor-not-allowed"
                                                title="User is inactive (Cannot Edit)">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        @endif

                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            class="m-0 d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-danger fs-5 border-0 bg-transparent p-0 d-inline-block"
                                                title="Delete User" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-3 text-black-50 d-block"></i>
                                    <span>No users found matching the criteria.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    {{-- Pagination Links --}}
    @if ($users->total() > 4)
        <div
            class="card-footer bg-white border-top border-light-subtle d-flex justify-content-between align-items-center py-2 px-4">

            <div class="text-muted small" style="font-size: 0.8rem;">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
            </div>

            <nav>
                <ul class="pagination pagination-sm m-0">
                    {{-- Previous Link --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}"
                                rel="prev">&lsaquo;</a></li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach (range(1, min(4, $users->lastPage())) as $i)
                        @if ($i == $users->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $users->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endforeach

                    @if ($users->lastPage() > 4)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif

                    {{-- Next Link --}}
                    @if ($users->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}"
                                rel="next">&rsaquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li>
                    @endif
                </ul>
            </nav>

        </div>
    @endif
    </div>
@endsection
