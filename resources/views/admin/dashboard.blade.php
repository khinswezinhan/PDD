@extends('components.admin-layout')

@section('content')
    <div class="container-fluid px-md-7" style="max-width: 1140px;">

        {{-- Header Title --}}
        <div class="mb-5">
            <h2 class="h4 font-weight-bold text-dark" style="letter-spacing: -0.5px;">
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
                                    <p class="text-uppercase text-muted small font-weight-bold mb-1">Total Users</p>
                                    <h3 class="fw-bold text-dark mb-2" style="font-size: 1.8rem;">
                                        {{ number_format($userCount ?? 0) }}
                                    </h3>
                                    <div class="text-success small d-flex align-items-center">
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
                            <p class="text-uppercase text-muted small font-weight-bold mb-1">Total Division</p>
                            <h3 class="fw-bold text-dark mb-2" style="font-size: 1.8rem;">
                                {{ number_format($activeDivisionsCount ?? 0) }}
                            </h3>
                            <div class="text-primary small d-flex align-items-center">
                                <span>+{{ $newDivisionsThisMonth ?? 0 }} This Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
