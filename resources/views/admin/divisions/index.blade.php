@extends('layouts.admin')

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
                <h4 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">Divisions List</h4>
            </div>
            <a href="{{ route('admin.divisions.create') }}"
                class="btn btn-primary px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center">
                Create Division
            </a>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom border-secondary-subtle">
                        <tr class="text-secondary small text-uppercase fw-bold"
                            style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            <th scope="col" class="ps-4 py-3 text-center" style="width: 80px;">No</th>
                            <th scope="col" class="py-3 ps-3">Division Name</th>
                            <th scope="col" class="py-3 text-end pe-4" style="width: 240px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($divisions as $key => $division)
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-3 text-center fw-semibold text-muted" style="font-size: 0.9rem;">
                                    {{ ($divisions->currentPage() - 1) * $divisions->perPage() + $key + 1 }}
                                </td>
                                <td class="ps-3 py-3">
                                    <span class="fw-bold text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $division->name }}
                                    </span>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-flex justify-content-end gap-2">
                                        {{-- Edit Button --}}
                                        <a href=""
                                            class="btn btn-sm btn-outline-primary px-3 rounded-2 d-inline-flex align-items-center fw-medium">
                                            <i class="fas fa-edit me-1 small"></i> Edit
                                        </a>

                                        {{-- Delete Button (အလုပ်လုပ်အောင် Comment ပြန်ဖွင့်ပေးထားပါတယ်) --}}
                                        {{-- <form action="{{ route('divisions.destroy', $division->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('ဤတိုင်းဒေသကြီးကို ဖျက်ရန် သေချာပါသလား?')">
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
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3 text-black-50 d-block"></i>
                                    <span>ဒေတာမရှိသေးပါ။ <strong>Create Division</strong> ခလုတ်မှတစ်ဆင့်
                                        စတင်ထည့်သွင်းပါ။</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($divisions->hasPages())
                <div
                    class="card-footer bg-white border-top border-light-subtle d-flex justify-content-between align-items-center py-3 px-4">
                    <div class="text-muted small">
                        Showing {{ $divisions->firstItem() }} to {{ $divisions->lastItem() }} of {{ $divisions->total() }}
                        entries
                    </div>
                    <div>
                        {{ $divisions->links() }}
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
