@extends('components.admin-layout')

@section('content')
    <!-- Tailwind Container -->
    <div class="w-full max-w-[700px] mx-auto px-4 md:px-6 py-8">

        {{-- Header Title --}}
        <div class="mb-5">
            <h4 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight m-0">
                Edit Admin User
            </h4>
        </div>

        {{-- Main Card Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
            <!-- Action ကို update route ပြောင်းပြီး method('PUT') ထည့်ထားပါတယ် -->
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name Input --}}
                <div class="mb-5">
                    <label for="name" class="block text-xs font-bold uppercase text-gray-500 tracking-wider mb-2">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-lg border-gray-300 text-sm py-2.5 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                    @error('name')
                        <div class="text-red-500 text-xs flex items-center gap-1 mt-2 font-medium">
                            <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Role Dropdown --}}
                <div class="mb-5">
                    <label for="role_id" class="block text-xs font-bold uppercase text-gray-500 tracking-wider mb-2">
                        Role
                    </label>
                    <select name="role_id" id="role_id" required
                        class="w-full rounded-lg border-gray-300 text-sm py-2.5 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">--Select a role--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Email Input --}}
                <div class="mb-5">
                    <label for="email" class="block text-xs font-bold uppercase text-gray-500 tracking-wider mb-2">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-lg border-gray-300 text-sm py-2.5 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                    @error('email')
                        <div class="text-red-500 text-xs flex items-center gap-1 mt-2 font-medium">
                            <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password Input (Optional for editing) --}}
                <div class="mb-5">
                    <label for="password" class="block text-xs font-bold uppercase text-gray-500 tracking-wider mb-2">
                        Password <span class="text-gray-400 font-normal lowercase">(leave blank if unchanged)</span>
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-lg border-gray-300 text-sm py-2.5 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                </div>

                {{-- Confirm Password Input --}}
                <div class="mb-5">
                    <label for="password_confirmation"
                        class="block text-xs font-bold uppercase text-gray-500 tracking-wider mb-2">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-lg border-gray-300 text-sm py-2.5 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Status Radio Buttons --}}
                <div class="mb-6">
                    <label class="block text-xs font-bold uppercase text-gray-500 tracking-wider mb-3">
                        Status
                    </label>
                    <div class="flex items-center gap-6 text-sm text-gray-700">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="status" value="active" id="active"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300"
                                {{ old('status', $user->status) == 'active' ? 'checked' : '' }}>
                            <span class="ml-2 font-medium">Active</span>
                        </label>

                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="status" value="inactive" id="inactive"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300"
                                {{ old('status', $user->status) == 'inactive' ? 'checked' : '' }}>
                            <span class="ml-2 font-medium">Inactive</span>
                        </label>
                    </div>

                    @error('status')
                        <span class="text-red-500 text-xs font-medium block mt-2">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Form Action Buttons --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-5 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-colors">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
