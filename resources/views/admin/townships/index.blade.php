@extends('components.admin-layout')

@section('content')
    {{-- Icons လေးတွေလှနေစေဖို့ FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-2" style="max-width: 1140px;">

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
                <h4 class="fw-bold text-dark fs-4 m-0" style="letter-spacing: -0.5px;">မြို့နယ်များ</h4>
            </div>
            <a href="{{ route('admin.townships.create') }}"
                class="btn text-white px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center gap-2 orange-btn">
                <span>မြို့နယ်အသစ်ထည့်ရန်</span>
            </a>
        </div>

        {{-- Search & Filter Section (ဒေတာ အလုပ်လုပ်စေမည့် ပုံစံအမှန်) --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 p-3 mb-4 bg-white">
            <form action="{{ route('admin.townships.index') }}" method="GET" class="row g-2 align-items-center">

                {{-- Box 1: မြို့နယ်အမည် ရိုက်ရှာရန် --}}
                <div class="col-12 col-md-3">
                    <div class="position-relative">
                        <span
                            class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa-solid fa-magnifying-glass fs-6"></i>
                        </span>
                        <input type="text" name="search_township" value="{{ request('search_township') }}"
                            class="form-control ps-5 border border-secondary-subtle rounded-2"
                            placeholder="မြို့နယ်အမည် ဖြင့်ရှာရန်..." style="height: 38px; font-size: 0.9rem;">
                    </div>
                </div>

                {{-- Box 2: ခရိုင်အမည် ရိုက်ရှာရန် --}}
                <div class="col-12 col-md-3">
                    <div class="position-relative">
                        <span
                            class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa-solid fa-magnifying-glass fs-6"></i>
                        </span>
                        <input type="text" name="search_district" value="{{ request('search_district') }}"
                            class="form-control ps-5 border border-secondary-subtle rounded-2"
                            placeholder="ခရိုင်အမည် ဖြင့်ရှာရန်..." style="height: 38px; font-size: 0.9rem;">
                    </div>
                </div>

                {{-- Box 3: တိုင်းဒေသကြီး/ပြည်နယ် Dropdown Filter --}}
                <div class="col-12 col-md-3">
                    <select name="division_id" class="form-select border border-secondary-subtle rounded-2"
                        style="height: 38px; font-size: 0.9rem;">
                        <option value="">တိုင်းဒေသကြီး/ပြည်နယ် အားလုံး</option>
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
                        style="height: 40px; font-size: 14px; padding: 0 16px; color: white; background-color: orange; border-radius: 8px; cursor: pointer;">
                        ရှာရန်
                    </button>

                    @if (request()->filled('search_township') || request()->filled('search_district') || request()->filled('division_id'))
                        <a href="{{ route('admin.townships.index') }}"
                            class="btn btn-light border px-3 rounded-2 fw-semibold d-inline-flex align-items-center text-dark"
                            style="height: 38px; font-size: 0.9rem;">
                            Clear
                        </a>
                    @endif
                </div>

            </form>
        </div>

        {{-- Data Table Section --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom border-secondary-subtle align-middle">
                        <tr class="text-secondary fw-bold text-nowrap" style="font-size: 0.95rem;">
                            <th scope="col" class="py-3 text-center" style="width: 70px;">စဥ်</th>
                            <th scope="col" class="py-3 ps-3">မြို့နယ်အမည်</th>
                            <th scope="col" class="py-3 ps-3">ခရိုင်အမည်</th>
                            <th scope="col" class="py-3 ps-3">တိုင်းဒေသကြီး/ပြည်နယ်အမည်</th>
                            <th scope="col" class="py-3 text-center" style="width: 180px;">လုပ်ဆောင်ချက်များ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($townships as $key => $township)
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-3 text-center fw-normal text-muted" style="font-size: 0.9rem;">
                                    {{ ($townships->currentPage() - 1) * $townships->perPage() + $key + 1 }}
                                </td>
                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $township->name }}
                                    </span>
                                </td>
                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $township->district->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $township->district->division->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <!-- ပြင်ဆင်ရန် နေရာ -->
                                <td class="text-center py-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.townships.edit', $township->id) }}"
                                            class="text-warning fs-5 d-inline-flex justify-content-center align-items-center rounded-circle"
                                            style="width: 36px; height: 36px;" title="Edit Township">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3 text-black-50 d-block"></i>
                                    <span>ဒေတာမရှိသေးပါ။ <strong>မြို့နယ်အသစ်ထည့်ရန်</strong> ခလုတ်မှတစ်ဆင့်
                                        စတင်ထည့်သွင်းပါ။</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div
                class="card-footer bg-white border-top border-light-subtle d-flex justify-content-between align-items-center py-2 px-4">

                {{-- ဘယ်ဘက်ခြမ်း: စာသားသီးသန့် --}}
                <div class="text-muted small" style="font-size: 0.8rem;">
                    Showing {{ $townships->firstItem() }} to {{ $townships->lastItem() }} of {{ $townships->total() }}
                    entries
                </div>

                {{-- ညာဘက်ခြမ်း: Custom Pagination ($townships အတွက်) --}}
                <nav>
                    <ul class="pagination pagination-sm m-0">

                        {{-- Previous Page Link --}}
                        @if ($townships->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $townships->previousPageUrl() }}"
                                    rel="prev">&lsaquo;</a></li>
                        @endif

                        {{-- Page 1, 2, 3, 4 ပြသခြင်း --}}
                        @foreach (range(1, min(4, $townships->lastPage())) as $i)
                            @if ($i == $townships->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $townships->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endforeach

                        {{-- စာမျက်နှာ ၄ ခုထက်ပိုပါက ... ပြသခြင်း --}}
                        @if ($townships->lastPage() > 4)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($townships->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $townships->nextPageUrl() }}"
                                    rel="next">&rsaquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li>
                        @endif

                    </ul>
                </nav>

            </div>
        </div>

    </div>
@endsection
