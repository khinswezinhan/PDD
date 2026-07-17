@extends('components.admin-layout')

@section('content')
    <!-- Container -->
    <div class="w-full px-4 md:px-6 pt-2 mt-3 max-w-[1140px] mx-auto">

        {{-- Header Title --}}
        <div class="mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 tracking-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Total Users Card --}}
            @auth
                @if (auth()->user()->role_id == 1)
                    <!-- border-solid border-l-4 border-emerald-500 hover:border-blue-600 သို့ ပြောင်းထားပါတယ် -->
                    <div
                        class="bg-white h-full rounded-lg shadow-sm border-solid border-l-4 border-emerald-500 transition-all duration-300 hover:border-blue-600 hover:-translate-y-1 hover:shadow-md cursor-pointer transform">
                        <div class="p-6 flex justify-between items-start">
                            <div>
                                <p class="uppercase text-gray-500 text-xs font-bold tracking-wider mb-1">Total Users</p>
                                <h3 class="font-bold text-gray-900 text-3xl mb-2">
                                    {{ number_format($userCount ?? 0) }}
                                </h3>
                                <div class="text-emerald-600 text-sm flex items-center font-semibold">
                                    <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                    <span>+{{ $newUsersToday ?? 0 }} New Today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            {{-- Total Division Card --}}
            <div
                class="bg-white h-full rounded-lg shadow-sm border-solid border-l-4 border-blue-500 transition-all duration-300 hover:border-blue-600 hover:-translate-y-1 hover:shadow-md cursor-pointer transform">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <p class="uppercase text-gray-500 text-xs font-bold tracking-wider mb-1">Total Division</p>
                        <h3 class="font-bold text-gray-900 text-3xl mb-2">
                            {{ number_format($activeDivisionsCount ?? 0) }}
                        </h3>
                        <div class="text-blue-600 text-sm flex items-center font-semibold">
                            <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                            <span>+{{ $newDivisionsThisMonth ?? 0 }} This Month</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total District Card --}}
            <div
                class="bg-white h-full rounded-lg shadow-sm border-solid border-l-4 border-blue-500 transition-all duration-300 hover:border-blue-600 hover:-translate-y-1 hover:shadow-md cursor-pointer transform">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <p class="uppercase text-gray-500 text-xs font-bold tracking-wider mb-1">Total District</p>
                        <h3 class="font-bold text-gray-900 text-3xl mb-2">
                            {{ number_format($activeDistrictsCount ?? 0) }}
                        </h3>
                        <div class="text-blue-600 text-sm flex items-center font-semibold">
                            <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                            <span>+{{ $newDistrictsThisMonth ?? 0 }} This Month</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Township Card --}}
            <div
                class="bg-white h-full rounded-lg shadow-sm border-solid border-l-4 border-blue-500 transition-all duration-300 hover:border-blue-600 hover:-translate-y-1 hover:shadow-md cursor-pointer transform">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <p class="uppercase text-gray-500 text-xs font-bold tracking-wider mb-1">Total Township</p>
                        <h3 class="font-bold text-gray-900 text-3xl mb-2">
                            {{ number_format($activeTownshipsCount ?? 0) }}
                        </h3>
                        <div class="text-blue-600 text-sm flex items-center font-semibold">
                            <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                            <span>+{{ $newTownshipsThisMonth ?? 0 }} This Month</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Pagoda Card --}}
            <div
                class="bg-white h-full rounded-lg shadow-sm border-solid border-l-4 border-blue-500 transition-all duration-300 hover:border-blue-600 hover:-translate-y-1 hover:shadow-md cursor-pointer transform">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <p class="uppercase text-gray-500 text-xs font-bold tracking-wider mb-1">Total Pagoda</p>
                        <h3 class="font-bold text-gray-900 text-3xl mb-2">
                            {{ number_format($activePagodasCount ?? 0) }}
                        </h3>
                        <div class="text-blue-600 text-sm flex items-center font-semibold">
                            <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                            <span>+{{ $newPagodasThisMonth ?? 0 }} This Month</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
