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
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Users List</h3>
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition shadow text-sm">
                Create User
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
                        style="height: 40px; font-size: 14px; padding: 0 16px; color: white; background-color: #1f2937; border-radius: 8px; cursor: pointer;">
                        Filter
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
        <div
            class="w-full bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto w-full">
                <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-left table-auto">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Role</th>
                            <th
                                class="px-6 py-3 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right whitespace-nowrap"
                                width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($users as $index => $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-950 dark:text-white font-medium whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-950 dark:text-white font-medium whitespace-nowrap">
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                        {{ $user->role?->role_name ?? 'No Role' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium inline-block">
                                        <i class="fa-solid fa-pen-to-square text-base"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium inline-block alignment-middle"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash text-base"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fa-solid fa-user-slash mb-2 text-xl block"></i>
                                    No users found matching the criteria.
                                </td>
                            </tr>
                        @endforelse {{-- ဤနေရာတွင် @endforelse ဖြင့် မှန်ကန်စွာ ပိတ်ပေးထားပြီးဖြစ်ပါတယ် --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4 px-2">
            {{ $users->links() }}
        </div>
    </div>
@endsection
