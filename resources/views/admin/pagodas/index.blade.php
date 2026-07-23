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
                <h4 class="fw-bold text-dark fs-4 m-0" style="letter-spacing: -0.5px;">ဘုရားစေတီပုထိုးများ</h4>
            </div>
            <a href="{{ route('admin.pagodas.create') }}"
                class="btn text-white px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center gap-2 orange-btn">
                <span>စေတီပုထိုးအသစ်ထည့်ရန်</span>
            </a>
        </div>

        {{-- 🔍 Search & Filter Section အသစ် --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 p-3 mb-4 bg-white">
            <form action="{{ route('admin.pagodas.index') }}" method="GET" class="row g-2 align-items-center">

                {{-- Box 1: စေတီပုထိုးအမည် ဖြင့်ရှာရန် --}}
                <div class="col-12 col-md-3">
                    <div class="position-relative">
                        <span
                            class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa-solid fa-magnifying-glass fs-6"></i>
                        </span>
                        <input type="text" name="search_pagoda" value="{{ request('search_pagoda') }}"
                            class="form-control ps-5 border border-secondary-subtle rounded-2"
                            placeholder="စေတီပုထိုးအမည် ဖြင့်ရှာရန်..." style="height: 38px; font-size: 0.9rem;">
                    </div>
                </div>

                {{-- Box 2: မြို့နယ်အမည် ဖြင့်ရှာရန် --}}
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

                {{-- Box 3: တိုင်းဒေသကြီး Filter Dropdown --}}
                <div class="col-12 col-md-3">
                    <select name="division_id" class="form-select border border-secondary-subtle rounded-2"
                        style="height: 38px; font-size: 0.9rem;">
                        <option value="">တိုင်းဒေသကြီး အားလုံး</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ခလုတ်များ --}}
                <div class="col-12 col-md-auto d-flex gap-2">
                    <button type="submit"
                        style="height: 40px; font-size: 14px; padding: 0 16px; color: white; background-color: orange; border-radius: 8px; cursor: pointer;">
                        Filter
                    </button>

                    @if (request()->filled('search_pagoda') || request()->filled('search_township') || request()->filled('division_id'))
                        <a href="{{ route('admin.pagodas.index') }}"
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
                    <thead class="bg-light border-bottom border-secondary-subtle">
                        <tr class="text-secondary text-uppercase fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">
                            <th scope="col" class="ps-4 py-3 text-center" style="width: 80px;">စဥ်</th>
                            <th scope="col" class="py-3 ps-3">စေတီပုထိုးအမည်</th>
                            <th scope="col" class="py-3 ps-3">တိုင်းဒေသကြီး</th>
                            <th scope="col" class="py-3 ps-3">ခရိုင်</th>
                            <th scope="col" class="py-3 ps-3">မြို့နယ်</th>
                            <th scope="col" class="py-3 ps-3" style="width: 100px;">ဓာတ်ပုံ</th>
                            <th scope="col" class="py-3 ps-3">ဝဘ်ဆိုက်</th>
                            <th scope="col" class="py-3 ps-3">လိပ်စာ</th>
                            <th scope="col" class="py-3 ps-3" style="width: 200px;">သမိုင်းအကျဉ်း</th>
                            <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">ပြင်ဆင်ချက်များ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pagodas as $key => $pagoda)
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-3 text-center fw-normal text-muted" style="font-size: 0.9rem;">
                                    {{ ($pagodas->currentPage() - 1) * $pagodas->perPage() + $key + 1 }}
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.9rem;">
                                        {{ $pagoda->name }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.9rem;">
                                        {{ $pagoda->township->district->division->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.9rem;">
                                        {{ $pagoda->township->district->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.9rem;">
                                        {{ $pagoda->township->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    @if ($pagoda->photo)
                                        <img src="{{ asset($pagoda->photo) }}" alt="{{ $pagoda->name }}"
                                            class="rounded shadow-sm border"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="badge bg-light text-muted border">ဓာတ်ပုံမရှိပါ</span>
                                    @endif
                                </td>

                                <td class="ps-3 py-3">
                                    @if ($pagoda->website)
                                        <a href="{{ $pagoda->website }}" target="_blank"
                                            class="text-decoration-none small text-truncate d-inline-block"
                                            style="max-width: 120px;">
                                            <i class="fas fa-external-link-alt me-1"></i> Visit
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.9rem;">
                                        {{ Str::limit($pagoda->address, 30, '...') }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.9rem;">
                                        {{ Str::limit($pagoda->history, 50, '...') }}
                                    </span>
                                </td>

                                <td class="text-end pe-4 py-3">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.pagodas.edit', $pagoda->id) }}"
                                            class="text-warning fs-5 d-inline-block" title="Edit Pagoda">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3 text-black-50 d-block"></i>
                                    <span>ဒေတာမရှိသေးပါ။ <strong>စေတီပုထိုးအသစ်ထည့်ရန်</strong> ခလုတ်မှတစ်ဆင့်
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
                    Showing {{ $pagodas->firstItem() }} to {{ $pagodas->lastItem() }} of {{ $pagodas->total() }}
                    entries
                </div>

                {{-- ညာဘက်ခြမ်း: Custom Pagination ($pagodas အတွက်) --}}
                <nav>
                    <ul class="pagination pagination-sm m-0">

                        {{-- Previous Page Link --}}
                        @if ($pagodas->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $pagodas->previousPageUrl() }}"
                                    rel="prev">&lsaquo;</a></li>
                        @endif

                        {{-- Page 1, 2, 3, 4 ပြသခြင်း --}}
                        @foreach (range(1, min(4, $pagodas->lastPage())) as $i)
                            @if ($i == $pagodas->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagodas->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endforeach

                        {{-- စာမျက်နှာ ၄ ခုထက်ပိုပါက ... ပြသခြင်း --}}
                        @if ($pagodas->lastPage() > 4)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($pagodas->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $pagodas->nextPageUrl() }}"
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
