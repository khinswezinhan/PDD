@extends('components.admin-layout')
@section('content')
    {{-- Icons လေးတွေလှနေစေဖို့ FontAwesome CDN လှမ်းချိတ်ပေးထားပါတယ် --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-2" style="max-width: 1140px;">

        {{-- Success Message Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        {{-- Header Section (Create Button ပါဝင်သောအပိုင်း) --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark fs-4 m-0" style="letter-spacing: -0.5px;">တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ</h4>
            </div>
            <a href="{{ route('admin.divisions.create') }}"
                class="btn text-white px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center gap-2 orange-btn">
                <span>တိုင်းဒေသကြီး/ပြည်နယ်အသစ်ထည့်ရန်</span>
            </a>
        </div>

        {{-- Search & Filter Section --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 p-3 mb-4 bg-white">
            <form action="{{ route('admin.divisions.index') }}" method="GET" class="row g-2 align-items-center">

                {{-- Search Input Box --}}
                <div class="col-12 col-md-4">
                    <div class="position-relative">
                        <span
                            class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa-solid fa-magnifying-glass fs-6"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control ps-5 border border-secondary-subtle rounded-2"
                            placeholder="တိုင်းဒေသကြီး/ပြည်နယ်အမည်ဖြင့်ရှာရန်" style="height: 38px; font-size: 0.9rem;">
                    </div>
                </div>

                {{-- Division Dropdown Filter --}}
                <div class="col-12 col-md-3">
                    <select name="division_id" class="form-select border border-secondary-subtle rounded-2"
                        style="height: 38px; font-size: 0.9rem;">
                        <option value="">တိုင်းဒေသကြီး/ပြည်နယ်အားလုံး</option>
                        @foreach ($all_divisions as $div)
                            <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                                {{ $div->name }}
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

                    @if (request()->filled('search') || request()->filled('division_id'))
                        <a href="{{ route('admin.divisions.index') }}"
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
                <!-- table-sm ကို ဆက်သုံးထားပါတယ် -->
                <table class="table table-hover table-sm align-middle mb-0">
                    <thead class="bg-light border-bottom border-secondary-subtle align-middle">
                        <tr class="text-secondary fw-bold text-nowrap" style="font-size: 0.95rem;">
                            <th scope="col" class="py-3 text-center" style="width: 70px;">စဥ်</th>
                            <th scope="col" class="py-3 ps-3">တိုင်းဒေသကြီး/ပြည်နယ်</th>
                            <th scope="col" class="py-3 ps-3">ဓာတ်ပုံ</th>
                            <th scope="col" class="py-3 text-center" style="width: 180px;">လုပ်ဆောင်ချက်များ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($divisions as $key => $division)
                            <tr class="border-bottom border-light">
                                <!-- <td> ထဲက py-3 တွေကို py-2 ပြောင်းလိုက်လို့ အကွက်တွေ သေးသွားပါပြီ -->
                                <td class="ps-4 py-2 text-center fw-normal text-muted" style="font-size: 0.85rem;">
                                    {{ ($divisions->currentPage() - 1) * $divisions->perPage() + $key + 1 }}
                                </td>
                                <td class="ps-3 py-2">
                                    <span class="fw-normal text-secondary-emphasis" style="font-size: 0.95rem;">
                                        {{ $division->name }}
                                    </span>
                                </td>
                                <td class="ps-3 py-2">
                                    @if (!empty($division->photo))
                                        <!-- url() အစား asset() ပြောင်းသုံးထားပြီး Path ရှေ့မှာ '/' ခံထားပါတယ် -->
                                        <img src="{{ asset('/' . $division->photo) }}" alt="{{ $division->name }}"
                                            class="img-thumbnail"
                                            style="width: 40px; height: 40px; object-fit: cover; display: block;">
                                    @else
                                        <span class="text-muted" style="font-size: 0.8rem;">ဓာတ်ပုံမရှိပါ</span>
                                    @endif
                                </td>
                                <!-- ပြင်ဆင်ရန် နေရာ -->
                                <td class="text-center py-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.divisions.edit', $division->id) }}"
                                            class="text-warning fs-5 d-inline-flex justify-content-center align-items-center rounded-circle"
                                            style="width: 36px; height: 36px;" title="Edit Division">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-2 text-black-50 d-block"></i>
                                    <span>ဒေတာမရှိသေးပါ။ <strong>တိုင်းဒေသကြီး/ပြည်နယ် အသစ်ထည့်ရန်</strong> ခလုတ်မှတစ်ဆင့်
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
                    Showing {{ $divisions->firstItem() }} to {{ $divisions->lastItem() }} of {{ $divisions->total() }}
                    entries
                </div>

                {{-- ညာဘက်ခြမ်း: Custom Pagination ($divisions အတွက်) --}}
                <nav>
                    <ul class="pagination pagination-sm m-0">

                        {{-- Previous Page Link --}}
                        @if ($divisions->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $divisions->previousPageUrl() }}"
                                    rel="prev">&lsaquo;</a></li>
                        @endif

                        {{-- Page 1, 2, 3, 4 ပြသခြင်း --}}
                        @foreach (range(1, min(4, $divisions->lastPage())) as $i)
                            @if ($i == $divisions->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $divisions->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endforeach

                        {{-- စာမျက်နှာ ၄ ခုထက်ပိုပါက ... ပြသခြင်း --}}
                        @if ($divisions->lastPage() > 4)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($divisions->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $divisions->nextPageUrl() }}"
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
