@extends('components.admin-layout')

@section('content')
    {{-- Icons လေးတွေလှနေစေဖို့ FontAwesome CDN လှမ်းချိတ်ပေးထားပါတယ် --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-5" style="max-width: 1140px;">

        {{-- Success Message Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark fs-4 m-0" style="letter-spacing: -0.5px;">ခရိုင်များ</h4>
            </div>
            <a href="{{ route('admin.districts.create') }}"
                class="btn btn-primary px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center">
                ခရိုင်အသစ်ထည့်ရန်
            </a>
        </div>

        {{-- Search & Filter Section --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 p-3 mb-4 bg-white">
            <form action="{{ route('admin.districts.index') }}" method="GET" class="row g-2 align-items-center">

                {{-- Search Box --}}
                <div class="col-12 col-md-4">
                    <div class="position-relative">
                        <!-- Icon Alignment နေရာကွက်တိညှိထားပါတယ် -->
                        <span
                            class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa-solid fa-magnifying-glass fs-6"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control ps-5 border border-secondary-subtle rounded-2"
                            placeholder="ခရိုင်အမည်ြဖင့်ရှာရန်" style="height: 38px; font-size: 0.9rem;">
                    </div>
                </div>

                {{-- Division Dropdown Filter --}}
                <div class="col-12 col-md-3">
                    <select name="division_id" class="form-select border border-secondary-subtle rounded-2"
                        style="height: 38px; font-size: 0.9rem;">
                        <option value="">တိုင်းဒေသကြီး/ပြည်နယ်အားလုံး</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div class="col-12 col-md-auto d-flex gap-2">
                    <button type="submit"
                        class="btn btn-secondary px-3 rounded-2 fw-semibold d-inline-flex align-items-center"
                        style="height: 38px; font-size: 0.9rem;">
                        Filter
                    </button>

                    @if (request()->filled('search') || request()->filled('division_id'))
                        <a href="{{ route('admin.districts.index') }}"
                            class="btn btn-light border px-3 rounded-2 fw-semibold d-inline-flex align-items-center text-dark"
                            style="height: 38px; font-size: 0.9rem;">
                            Clear
                        </a>
                    @endif
                </div>

            </form>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom border-secondary-subtle">
                        <tr class="text-secondary text-uppercase fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">
                            <th scope="col" class="ps-4 py-3 text-center" style="width: 80px;">စဥ်</th>
                            <th scope="col" class="py-3 ps-3">ခရိုင်အမည်</th>
                            <th scope="col" class="py-3 ps-3">တိုင်းဒေသကြီး/ပြည်နယ်</th>
                            <th scope="col" class="py-3 text-end pe-4" style="width: 240px;">လုပ်ဆောင်ချက်များ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($districts as $key => $district)
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-3 text-center fw-semibold text-muted" style="font-size: 0.9rem;">
                                    {{ ($districts->currentPage() - 1) * $districts->perPage() + $key + 1 }}
                                </td>
                                <td class="ps-3 py-3">
                                    <span class="fw-bold text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $district->name }}
                                    </span>
                                </td>
                                <td class="ps-3 py-3">
                                    <span class="fw-bold text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $district->division->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-flex justify-content-end gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.districts.edit', $district->id) }}"
                                            class="btn btn-sm btn-outline-primary px-3 rounded-2 d-inline-flex align-items-center fw-medium">
                                            <i class="fas fa-edit me-1 small"></i> ပြင်ဆင်ရန်
                                        </a>

                                        {{-- Delete Button (အလုပ်လုပ်အောင် Comment ပြန်ဖွင့်ပေးထားပါတယ်) --}}
                                        {{-- <form action="{{ route('divisions.destroy', $division->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('ဤတိုင်းဒေသကြီးကို ဖျက်ရန် သေချာပါသလည့်လည့်?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger px-3 rounded-2 d-inline-flex align-items-center fw-medium">
                                                <i class="fas fa-trash-alt me-1 small"></i> Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3 text-black-50 d-block"></i>
                                    <span>ဒေတာမရှိသေးပါ။ <strong>ခရိုင်အသစ်ထည့်ရန်</strong> ခလုတ်မှတစ်ဆင့်
                                        စတင်ထည့်သွင်းပါ။</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($districts->hasPages())
                <div
                    class="card-footer bg-white border-top border-light-subtle d-flex justify-content-between align-items-center py-3 px-4">
                    <div class="text-muted small">
                        Showing {{ $districts->firstItem() }} to {{ $districts->lastItem() }} of
                        {{ $districts->total() }}
                        entries
                    </div>
                    <div>
                        {{ $districts->links() }}
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
