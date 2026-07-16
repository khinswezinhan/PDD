@extends('components.admin-layout')

@section('content')
    <!-- pt-2 mt-3 ကို ထည့်သွင်းပြီး Layout အသစ်နဲ့ အချိုးကျအောင် ညှိထားပါတယ် -->
    <div class="container-fluid px-md-4 pt-2 mt-3" style="max-width: 1140px;">

        {{-- Header Title --}}
        <!-- mb-4 သို့ လျှော့ချပြီး နေရာလွတ်ကို အချိုးကျအောင် လုပ်ထားပါတယ် -->
        <div class="mb-4">
            <h2 class="h4 fw-bold text-dark" style="letter-spacing: -0.5px;">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>

        <div class="row g-4">
            {{-- Total Users Card --}}
            @auth
                @if (auth()->user()->role_id == 1)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-start border-primary border-4">
                            <div class="card-body d-flex justify-content-between align-items-start p-4">
                                <div>
                                    <p class="text-uppercase text-muted small fw-bold mb-1"
                                        style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Users</p>
                                    <h3 class="fw-bold text-dark mb-2" style="font-size: 1.75rem;">
                                        {{ number_format($userCount ?? 0) }}
                                    </h3>
                                    <div class="text-success small d-flex align-items-center fw-medium">
                                        <i class="fas fa-arrow-up me-1 small"></i>
                                        <span>+{{ $newUsersToday ?? 0 }} New Today</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            {{-- Total Division Card --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm border-start border-primary border-4">
                    <div class="card-body d-flex justify-content-between align-items-start p-4">
                        <div>
                            <p class="text-uppercase text-muted small fw-bold mb-1"
                                style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Division</p>
                            <h3 class="fw-bold text-dark mb-2" style="font-size: 1.75rem;">
                                {{ number_format($activeDivisionsCount ?? 0) }}
                            </h3>
                            <div class="text-primary small d-flex align-items-center fw-medium">
                                <i class="fas fa-calendar-alt me-1 small"></i>
                                <span>+{{ $newDivisionsThisMonth ?? 0 }} This Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
