<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Semantics Search Pagoda Digital Directory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23f59e0b'%3E%3Cpath d='M12 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 2zm0 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm1.2 4.14A3.48 3.48 0 0 0 12 9a3.48 3.48 0 0 0-1.2.64L12 14l1.2-4.36zM12 15c-1.66 0-3-1.34-3-3l1.35-4.86c.15-.55.65-.94 1.23-.94s1.08.39 1.23.94L14.35 12c0 1.66-1.34 3-3 3zm-4.5 3h9l-1-2.5h-7l-1 2.5zm-2.5 3h14l-1-2.5h-12l-1 2.5z'/%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ၁။ Sidebar Buttons Styling */
        .sidebar-btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 6px 10px;
            margin-bottom: 2px;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            text-decoration: none;
            background-color: #f8f9fa;
            color: #fd7e14;
            border: 1px solid #e9ecef;
        }

        .sidebar-btn-hover:hover {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            border-color: #fd7e14;
            transform: translateX(2px);
        }

        .sidebar-btn-active {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            border-color: #fd7e14 !important;
        }

        .sidebar-btn span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ၂။ Responsive Mobile Menu */
        @media (max-width: 768px) {
            .main-wrapper {
                flex-direction: column !important;
            }

            .sidebar-container {
                width: 100% !important;
                min-width: 100% !important;
                border-bottom: 1px solid #dee2e6;
                border-right: none !important;
            }

            .sidebar-menu {
                flex-direction: row !important;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
            }
        }

        /* ၃။ Pagination Styles */
        .pagination .page-item.active .page-link {
            background-color: #fd7e14 !important;
            border-color: #fd7e14 !important;
            color: #ffffff !important;
        }

        .pagination .page-link {
            color: #fd7e14;
        }

        .pagination .page-link:hover {
            color: #e06d10;
        }

        /* ၄။ Orange Buttons & Custom Form Inputs */
        .orange-btn {
            background-color: #fd7e14;
            border-color: #fd7e14;
            color: #ffffff;
        }

        .orange-btn:hover {
            background-color: #e06d10;
            border-color: #e06d10;
            color: #ffffff;
        }

        /* ၅။ Input Focus Style (Orange Ring) */
        .form-select:focus,
        .form-control:focus,
        .custom-orange-input:focus {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25) !important;
            outline: none !important;
        }

        /* ၆။ Dropdown Hover Color (မီးခိုးရောင်ဖျော့ဖျော့ / Light Gray Hover) */
        .dropdown-menu .dropdown-item,
        .custom-dropdown-item {
            color: #333333 !important;
            transition: background-color 0.15s ease-in-out;
        }

        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus,
        .custom-dropdown-item:hover,
        .custom-dropdown-item:focus {
            background-color: #f1f5f9 !important;
            /* မီးခိုးရောင်ဖျော့ဖျော့ */
            color: #0f172a !important;
            /* စာသားအရောင် အနက်ရောင်/အနက်ရင့် */
        }

        .dropdown-menu .dropdown-item.active,
        .custom-dropdown-item.active {
            background-color: #f97316 !important;
            /* Selected ဖြစ်နေချိန်မှာပဲ လိမ္မော်ရောင်ပြမည် */
            color: #ffffff !important;
        }

        /* Standard HTML <select> element hover (Chrome/Edge အတွက်) */
        select option:hover,
        select option:focus {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }
    </style>

</head>

<body class="font-sans antialiased bg-light m-0 p-0">

    <!-- Navbar -->
    <header class="w-100 bg-gold border-bottom" style="position: relative; z-index: 1030;">
        @include('admin.layouts.nav')
    </header>

    <!-- Main Wrapper -->
    <div class="d-flex main-wrapper" style="min-height: calc(100vh - 56px); width: 100%;">

        <!-- [ဘယ်ဘက်ခြမ်း] - Sidebar -->
        <aside x-data="{ collapsed: false }" :class="collapsed ? 'w-14 min-w-[56px]' : 'w-64 min-w-[256px]'"
            class="bg-white border-end sidebar-container transition-all duration-300 relative flex-shrink-0">
            <!-- Collapsed Toggle Button -->
            <button @click="collapsed = !collapsed" type="button" style="right: -10px;"
                class="absolute top-3 bg-white border border-gray-300 rounded-full w-5 h-5 flex items-center justify-center text-gray-600 shadow-md hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-all duration-200 z-50 cursor-pointer"
                :title="collapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
                <i class="fas text-[9px]" :class="collapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
            </button>

            <div class="p-2">
                <ul class="nav flex-column gap-1 sidebar-menu">

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-btn {{ Request::is('admin/dashboard*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }} flex items-center transition-all duration-200"
                            :class="collapsed ? 'justify-center !px-0' : 'px-2.5'"
                            :title="collapsed ? 'Dashboard' : ''">
                            <i class="fa-solid fa-gauge-high flex-shrink-0" :class="collapsed ? '' : 'mr-2'"></i>
                            <span x-show="!collapsed" x-transition.opacity class="whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>

                    @auth
                        @if (auth()->user()->role_id == 1)
                            <!-- Admin Users -->
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="sidebar-btn {{ Request::is('admin/users*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }} flex items-center transition-all duration-200"
                                    :class="collapsed ? 'justify-center !px-0' : 'px-2.5'"
                                    :title="collapsed ? 'Admin Users' : ''">
                                    <i class="fas fa-users-cog flex-shrink-0" :class="collapsed ? '' : 'mr-2'"></i>
                                    <span x-show="!collapsed" x-transition.opacity class="whitespace-nowrap">Admin
                                        Users</span>
                                </a>
                            </li>
                        @endif
                    @endauth

                    <!-- တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.divisions.index') }}"
                            class="sidebar-btn {{ Request::is('admin/division*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }} flex items-center transition-all duration-200"
                            :class="collapsed ? 'justify-center !px-0' : 'px-2.5'"
                            :title="collapsed ? 'တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ' : ''">
                            <i class="fas fa-map-marked-alt flex-shrink-0" :class="collapsed ? '' : 'mr-2'"></i>
                            <span x-show="!collapsed" x-transition.opacity
                                class="whitespace-nowrap">တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ</span>
                        </a>
                    </li>

                    <!-- ခရိုင်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.districts.index') }}"
                            class="sidebar-btn {{ Request::is('admin/district*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }} flex items-center transition-all duration-200"
                            :class="collapsed ? 'justify-center !px-0' : 'px-2.5'"
                            :title="collapsed ? 'ခရိုင်များ' : ''">
                            <i class="fas fa-layer-group flex-shrink-0" :class="collapsed ? '' : 'mr-2'"></i>
                            <span x-show="!collapsed" x-transition.opacity class="whitespace-nowrap">ခရိုင်များ</span>
                        </a>
                    </li>

                    <!-- မြို့နယ်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.townships.index') }}"
                            class="sidebar-btn {{ Request::is('admin/township*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }} flex items-center transition-all duration-200"
                            :class="collapsed ? 'justify-center !px-0' : 'px-2.5'"
                            :title="collapsed ? 'မြို့နယ်များ' : ''">
                            <i class="fas fa-city flex-shrink-0" :class="collapsed ? '' : 'mr-2'"></i>
                            <span x-show="!collapsed" x-transition.opacity class="whitespace-nowrap">မြို့နယ်များ</span>
                        </a>
                    </li>

                    <!-- ဘုရားစေတီပုထိုးများ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pagodas.index') }}"
                            class="sidebar-btn {{ Request::is('admin/pagoda*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }} flex items-center transition-all duration-200"
                            :class="collapsed ? 'justify-center !px-0' : 'px-2.5'"
                            :title="collapsed ? 'ဘုရားစေတီပုထိုးများ' : ''">
                            <i class="fas fa-gopuram flex-shrink-0" :class="collapsed ? '' : 'mr-2'"></i>
                            <span x-show="!collapsed" x-transition.opacity
                                class="whitespace-nowrap">ဘုရားစေတီပုထိုးများ</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4 bg-light" style="min-width: 0;">
            @yield('content')
        </main>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
