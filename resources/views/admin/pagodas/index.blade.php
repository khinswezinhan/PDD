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
                <h4 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">ဘုရားစေတီပုထိုးများ</h4>
            </div>
            <a href="{{ route('admin.pagodas.create') }}"
                class="btn btn-primary px-4 py-2 shadow-sm rounded-2 fw-semibold d-inline-flex align-items-center">
                Create Pagoda
            </a>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom border-secondary-subtle">
                        <tr class="text-secondary small text-uppercase fw-bold"
                            style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            <th scope="col" class="ps-4 py-3 text-center" style="width: 80px;">No</th>
                            <th scope="col" class="py-3 ps-3">Pagoda Name</th>
                            <th scope="col" class="py-3 ps-3">Division Name</th>
                            <th scope="col" class="py-3 ps-3">District Name</th>
                            <th scope="col" class="py-3 ps-3">Township Name</th>
                            <th scope="col" class="py-3 ps-3" style="width: 100px;">Photo</th>
                            <th scope="col" class="py-3 ps-3">Website</th>
                            <th scope="col" class="py-3 ps-3">Address</th>
                            <th scope="col" class="py-3 ps-3" style="width: 200px;">History</th>
                            <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pagodas as $key => $pagoda)
                            <tr class="border-bottom border-light">
                                <td class="ps-4 py-3 text-center fw-semibold text-muted" style="font-size: 0.9rem;">
                                    {{ ($pagodas->currentPage() - 1) * $pagodas->perPage() + $key + 1 }}
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="fw-bold text-secondary-emphasis" style="font-size: 1rem;">
                                        {{ $pagoda->name }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="text-secondary" style="font-size: 0.95rem;">
                                        {{ $pagoda->township->district->division->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="text-secondary" style="font-size: 0.95rem;">
                                        {{ $pagoda->township->district->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="text-secondary" style="font-size: 0.95rem;">
                                        {{ $pagoda->township->name ?? 'N/A' }}
                                    </span>
                                </td>

                                {{-- 🌟 (၁) ပုံအစစ်ပေါ်လာအောင် img tag ဖြင့် ပြင်ဆင်ခြင်း --}}
                                <td class="ps-3 py-3">
                                    @if($pagoda->photo)
                                        <img src="{{ asset($pagoda->photo) }}" 
                                            alt="{{ $pagoda->name }}" 
                                            class="rounded shadow-sm border"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="badge bg-light text-muted border">No Image</span>
                                    @endif
                                </td>

                                <td class="ps-3 py-3">
                                    @if($pagoda->website)
                                        <a href="{{ $pagoda->website }}" target="_blank" class="text-decoration-none small text-truncate d-inline-block" style="max-width: 120px;">
                                            <i class="fas fa-external-link-alt me-1"></i> Visit
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="ps-3 py-3">
                                    <span class="text-secondary small" title="{{ $pagoda->address }}">
                                        {{ Str::limit($pagoda->address, 30, '...') }}
                                    </span>
                                </td>

                                {{-- 🌟 (၂) သမိုင်းစာသားအရှည်ကြီးကို "...." ဖြင့် ဖြတ်ပြခြင်း --}}
                                <td class="ps-3 py-3">
                                    <span class="text-muted small" title="{{ $pagoda->history }}">
                                        {{ Str::limit($pagoda->history, 50, '...') }}
                                    </span>
                                </td>
                                
                                <td class="text-end pe-4 py-3">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href=""
                                            class="btn btn-sm btn-outline-primary px-2 rounded-2 d-inline-flex align-items-center fw-medium">
                                            <i class="fas fa-edit me-1 small"></i> Edit
                                        </a>

                                        {{-- <form action="{{ route('admin.pagodas.destroy', $pagoda->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('ဤဗုဒ္ဓစေတီတော်ကို ဖျက်ရန် သေချာပါသလား?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger px-2 rounded-2 d-inline-flex align-items-center fw-medium">
                                                <i class="fas fa-trash-alt me-1 small"></i> Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                {{-- Column အားလုံးပေါင်း ၁၀ ခု ရှိသွား၍ colspan="10" သို့ ညှိလိုက်ပါသည် --}}
                                <td colspan="10" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3 text-black-50 d-block"></i>
                                    <span>ဒေတာမရှိသေးပါ။ <strong>Create Pagoda</strong> ခလုတ်မှတစ်ဆင့်
                                        စတင်ထည့်သွင်းပါ။</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pagodas->hasPages())
                <div
                    class="card-footer bg-white border-top border-light-subtle d-flex justify-content-between align-items-center py-3 px-4">
                    <div class="text-muted small">
                        Showing {{ $pagodas->firstItem() }} to {{ $pagodas->lastItem() }} of {{ $pagodas->total() }}
                        entries
                    </div>
                    <div>
                        {{ $pagodas->links() }}
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection