<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Semantics Search Pagoda Digital Directory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ၁။ Sidebar Buttons Styling */
        .sidebar-expanded {
            width: 320px !important;
            /* Sidebar Width ကို 280px အထိ တိုးလိုက်သည် */
        }

        .sidebar-collapsed {
            width: 68px !important;
        }

        .main-expanded {
            margin-left: 320px !important;
            /* Main content ပါ လိုက်ရွှေ့ပေးသည် */
        }

        .main-collapsed {
            margin-left: 68px !important;
        }

        /* Sidebar Buttons ဒီဇိုင်းသစ် (Center ကျပြီး လှပစေရန်) */
        .sidebar-btn {
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 10px 16px;
            /* Button အမြင့်နှင့် အကျယ် မျှအောင် တိုးထားသည် */
            margin-bottom: 8px !important;
            transition: all 0.25s ease-in-out;
            display: flex;
            align-items: center;
            text-decoration: none;
            background-color: #f8f9fa;
            color: #fd7e14;
            border: 1px solid #e9ecef;
            width: 100%;
            white-space: nowrap;
            /* Inner space ထဲမှာ အပြည့်နေရာယူစေရန် */
        }

        .sidebar-btn-hover:hover {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            border-color: #fd7e14;
            transform: translateX(4px);
            /* Hover လုပ်ရင် အနည်းငယ် ညာဘက်ရွှေ့သည့် effect */
            box-shadow: 0 4px 6px -1px rgba(253, 126, 20, 0.2);
        }

        .sidebar-btn-active {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            border-color: #fd7e14 !important;
            box-shadow: 0 4px 10px rgba(253, 126, 20, 0.3) !important;
        }

        /* ၂။ Fixed Layout Alignments (ဒီ CSS များက ပြဿနာကို အဓိက ရှင်းပေးပါမည်) */
        .layout-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            height: 60px !important;
            z-index: 1050 !important;
        }

        .layout-sidebar {
            position: fixed !important;
            top: 60px !important;
            bottom: 0 !important;
            left: 0 !important;
            z-index: 1000 !important;
            height: calc(100vh - 60px) !important;
            transition: width 0.3s ease;
        }

        .layout-main {
            margin-top: 60px !important;
            /* Navbar အောက် လွတ်စေရန် */
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 60px);
            width: 100%;
        }

        /* Sidebar State ကွာခြားချက် */
        .sidebar-expanded {
            width: 256px !important;
        }

        .sidebar-collapsed {
            width: 56px !important;
        }

        .main-expanded {
            margin-left: 256px !important;
            /* Sidebar Expand ဖြစ်ချိန် ဘယ်ဘက် Margin */
        }

        .main-collapsed {
            margin-left: 56px !important;
            /* Sidebar Collapse ဖြစ်ချိန် ဘယ်ဘက် Margin */
        }

        /* ၃။ Responsive Mobile View */
        @media (max-width: 768px) {
            .layout-sidebar {
                position: relative !important;
                top: 0 !important;
                width: 100% !important;
                height: auto !important;
            }

            .layout-main {
                margin-left: 0 !important;
                margin-top: 60px !important;
            }

            .sidebar-toggle-btn {
                display: none !important;
            }

            .sidebar-menu {
                flex-direction: row !important;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        /* ၄။ Craeate button */
        .orange-btn,
        .btn-orange,
        .btn-warning {
            background-color: #fd7e14 !important;
            border-color: #fd7e14 !important;
            color: #ffffff !important;
        }

        .orange-btn:hover,
        .btn-orange:hover,
        .btn-warning:hover {
            background-color: #e06d10 !important;
            border-color: #e06d10 !important;
            color: #ffffff !important;
        }

        /* ၅။ Pagination Colors (Active, Hover & Normal Links) */
        .pagination .page-item.active .page-link,
        .pagination .page-item.active span {
            background-color: #fd7e14 !important;
            border-color: #fd7e14 !important;
            color: #ffffff !important;
        }

        .pagination .page-link {
            color: #fd7e14 !important;
            background-color: #ffffff;
            border-color: #dee2e6;
        }

        .pagination .page-link:hover,
        .pagination .page-link:focus {
            color: #e06d10 !important;
            background-color: #ffe8d6 !important;
            /* Mouse တင်ချိန် နောက်ခံ လိမ္မော်နုရောင် */
            border-color: #fd7e14 !important;
            box-shadow: none !important;
        }

        /* Navbar User Dropdown Styling */
        .user-dropdown-menu {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
            padding: 8px !important;
            min-width: 200px !important;
            margin-top: 10px !important;
        }

        .user-dropdown-item {
            border-radius: 8px !important;
            padding: 10px 14px !important;
            font-weight: 500 !important;
            font-size: 0.9rem !important;
            color: #4b5563 !important;
            transition: all 0.2s ease-in-out !important;
            display: flex !important;
            align-items: center !important;
        }

        .user-dropdown-item:hover {
            background-color: #fff7ed !important;
            /* Soft Orange */
            color: #fd7e14 !important;
        }

        .user-dropdown-item.logout-item:hover {
            background-color: #fef2f2 !important;
            /* Soft Red */
            color: #ef4444 !important;
        }

        .dropdown-user-btn {
            border: 1px solid #e5e7eb !important;
            border-radius: 30px !important;
            padding: 6px 16px !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease !important;
        }

        .dropdown-user-btn:hover {
            border-color: #fd7e14 !important;
            box-shadow: 0 2px 6px rgba(253, 126, 20, 0.15) !important;
        }

        /* Dropdown Arrow Icon ဖျောက်ရန် */
        #userDropdown::after {
            display: none !important;
        }

        /* Button Focus ဖြစ်ချိန် Border/Outline ထွက်မလာစေရန် */
        #userDropdown:focus,
        #userDropdown:active {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-light m-0 p-0">

    <!-- Navbar Header -->
    <header class="w-100 bg-white border-bottom shadow-sm layout-header" style="background-color: #ffffff !important;">
        @include('admin.layouts.nav')
    </header>

    <!-- Outer Wrapper with Alpine State -->
    <div x-data="{ collapsed: false }" class="d-flex w-100 min-vh-100">

        <!-- [ဘယ်ဘက်ခြမ်း] - Sidebar -->
        <aside class="bg-white border-end sidebar-container relative flex-shrink-0 layout-sidebar shadow-sm"
            :class="collapsed ? 'sidebar-collapsed' : 'sidebar-expanded'">

            <!-- Collapsed Toggle Button -->
            <button @click="collapsed = !collapsed" type="button"
                class="sidebar-toggle-btn rounded-circle d-flex align-items-center justify-content-center text-secondary shadow-sm transition-all"
                style="position: absolute !important; top: 16px !important; right: -12px !important; z-index: 1050 !important; background-color: #ffffff; border: 1px solid #cbd5e1; width: 26px; height: 26px;"
                :title="collapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
                <i class="fas text-[10px]" :class="collapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
            </button>

            <!-- Scrollbar & Padding (p-3 pt-4 ဖြင့် Space မျှအောင် ညှိထားသည်) -->
            <div class="p-3 pt-4 h-100 overflow-y-auto w-100">
                <ul class="nav flex-column gap-1 sidebar-menu w-100 p-0 m-0">

                    <!-- Dashboard -->
                    <li class="nav-item w-100">
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-btn {{ Request::is('admin/dashboard*') ? 'sidebar-btn-active' : 'sidebar-btn-hover' }}"
                            :class="collapsed ? 'justify-content-center px-0' : ''"
                            :title="collapsed ? 'Dashboard' : ''">
                            <i class="fa-solid fa-gauge-high flex-shrink-0" :class="collapsed ? '' : 'me-3'"></i>
                            <span x-show="!collapsed" x-transition.opacity class="text-nowrap">Dashboard</span>
                        </a>
                    </li>

                    @auth
                        @if (auth()->user()->role_id == 1)
                            <!-- Admin Users -->
                            <li class="nav-item w-100">
                                <a href="{{ route('admin.users.index') }}"
                                    class="sidebar-btn {{ Request::is('admin/users*') ? 'sidebar-btn-active' : 'sidebar-btn-hover' }}"
                                    :class="collapsed ? 'justify-content-center px-0' : ''"
                                    :title="collapsed ? 'Admin Users' : ''">
                                    <i class="fas fa-users-cog flex-shrink-0" :class="collapsed ? '' : 'me-3'"></i>
                                    <span x-show="!collapsed" x-transition.opacity class="text-nowrap">Admin Users</span>
                                </a>
                            </li>
                        @endif
                    @endauth

                    <!-- တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ -->
                    <li class="nav-item w-100">
                        <a href="{{ route('admin.divisions.index') }}"
                            class="sidebar-btn {{ Request::is('admin/division*') ? 'sidebar-btn-active' : 'sidebar-btn-hover' }}"
                            :class="collapsed ? 'justify-content-center px-0' : ''"
                            :title="collapsed ? 'တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ' : ''">
                            <i class="fas fa-map-marked-alt flex-shrink-0" :class="collapsed ? '' : 'me-3'"></i>
                            <span x-show="!collapsed" x-transition.opacity
                                class="text-nowrap">တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ</span>
                        </a>
                    </li>

                    <!-- ခရိုင်များ -->
                    <li class="nav-item w-100">
                        <a href="{{ route('admin.districts.index') }}"
                            class="sidebar-btn {{ Request::is('admin/district*') ? 'sidebar-btn-active' : 'sidebar-btn-hover' }}"
                            :class="collapsed ? 'justify-content-center px-0' : ''"
                            :title="collapsed ? 'ခရိုင်များ' : ''">
                            <i class="fas fa-layer-group flex-shrink-0" :class="collapsed ? '' : 'me-3'"></i>
                            <span x-show="!collapsed" x-transition.opacity class="text-nowrap">ခရိုင်များ</span>
                        </a>
                    </li>

                    <!-- မြို့နယ်များ -->
                    <li class="nav-item w-100">
                        <a href="{{ route('admin.townships.index') }}"
                            class="sidebar-btn {{ Request::is('admin/township*') ? 'sidebar-btn-active' : 'sidebar-btn-hover' }}"
                            :class="collapsed ? 'justify-content-center px-0' : ''"
                            :title="collapsed ? 'မြို့နယ်များ' : ''">
                            <i class="fas fa-city flex-shrink-0" :class="collapsed ? '' : 'me-3'"></i>
                            <span x-show="!collapsed" x-transition.opacity class="text-nowrap">မြို့နယ်များ</span>
                        </a>
                    </li>

                    <!-- ဘုရားစေတီပုထိုးများ -->
                    <li class="nav-item w-100">
                        <a href="{{ route('admin.pagodas.index') }}"
                            class="sidebar-btn {{ Request::is('admin/pagoda*') ? 'sidebar-btn-active' : 'sidebar-btn-hover' }}"
                            :class="collapsed ? 'justify-content-center px-0' : ''"
                            :title="collapsed ? 'ဘုရားစေတီပုထိုးများ' : ''">
                            <i class="fas fa-gopuram flex-shrink-0" :class="collapsed ? '' : 'me-3'"></i>
                            <span x-show="!collapsed" x-transition.opacity
                                class="text-nowrap">ဘုရားစေတီပုထိုးများ</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>

        <!-- [ညာဘက်ခြမ်း] - Main Content Area -->
        <main class="flex-grow-1 p-4 bg-light layout-main" :class="collapsed ? 'main-collapsed' : 'main-expanded'">
            @yield('content')
        </main>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
