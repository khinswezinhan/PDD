<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Semantics Search Pagoda Digital Directory</title>

    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23f59e0b'%3E%3Cpath d='M12 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 2zm0 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm1.2 4.14A3.48 3.48 0 0 0 12 9a3.48 3.48 0 0 0-1.2.64L12 14l1.2-4.36zM12 15c-1.66 0-3-1.34-3-3l1.35-4.86c.15-.55.65-.94 1.23-.94s1.08.39 1.23.94L14.35 12c0 1.66-1.34 3-3 3zm-4.5 3h9l-1-2.5h-7l-1 2.5zm-2.5 3h14l-1-2.5h-12l-1 2.5z'/%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ၁။ Sidebar Item များကို အမြဲတမ်း Button ပုံစံ ပေါ်နေအောင် ပြုလုပ်ခြင်း */
        .sidebar-btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 18px;
            margin-bottom: 2px;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            text-decoration: none;

            /* မနှိပ်ထားတဲ့ ခလုတ်တွေကို မီးခိုးနုရောင် background နဲ့ လိမ္မော်ရောင် စာသား ပေးထားပါတယ် */
            background-color: #f8f9fa;
            color: #fd7e14;
            border: 1px solid #e9ecef;
        }

        /* ၂။ Hover လုပ်တဲ့အချိန် background လိမ္မော်ရောင်နုနု၊ စာသားဖြူ ပေါ်စေခြင်း */
        .sidebar-btn-hover:hover {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            border-color: #fd7e14;
            transform: translateX(4px);
        }

        /* Active ဖြစ်နေသော Button (ဥပမာ- Dashboard ရောက်နေချိန်) */
        .sidebar-btn-active {
            background-color: #fd7e14 !important;
            color: #ffffff !important;
            border-color: #fd7e14 !important;
        }

        /* ၃။ စာသားရှည်လည်း အောက်တန်းမကျသွားစေရန် */
        .sidebar-btn span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ၄။ Mobile Screen (Phone) တွေမှာ Sidebar ကို အပေါ်သို့ပို့ရန် သို့မဟုတ် ပျောက်ထားရန် */
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

            /* ဖုန်းပေါ်မှာ ခလုတ်တွေကို ဘေးတိုက်ပြသချင်ရင် */
            .sidebar-menu {
                flex-direction: row !important;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
            }
        }

        /* Pagination Active Button Color */
        .pagination .page-item.active .page-link {
            background-color: #fd7e14 !important;
            border-color: #fd7e14 !important;
            color: #ffffff !important;
        }

        /* Pagination Text Color on Hover */
        .pagination .page-link {
            color: #fd7e14;
        }

        .pagination .page-link:hover {
            color: #e06d10;
        }

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

        /* .sidebar-btn {
            background-color: #fff8f0;
            /* Soft Warm Cream */
        color: #e67e22;
        /* Deep Orange Text */
        border: 1px solid #ffe8d6;
        }

        */
    </style>

</head>

<body class="font-sans antialiased bg-light m-0 p-0">

    <!-- [၁] Navbar ကို အပေါ်ဆုံးမှာ 100% အပြည့် နေရာယူစေခြင်း -->
    <header class="w-100 bg-gold border-bottom" style="position: relative; z-index: 1030;">
        @include('admin.layouts.nav')
    </header>

    <!-- [၂] Navbar အောက်ရောက်မှ Sidebar နှင့် Content ကို ဘယ်/ညာ ခွဲခြင်း -->
    <div class="d-flex main-wrapper" style="min-height: calc(100vh - 56px); width: 100%;">

        <!-- [ဘယ်ဘက်ခြမ်း] - Sidebar -->
        <aside class="bg-white border-end sidebar-container" style="width: 280px; min-width: 280px; flex-shrink: 0;">
            <div class="p-3">
                <ul class="nav flex-column gap-2 sidebar-menu">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-btn {{ Request::is('admin/dashboard*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }}">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @auth
                        @if (auth()->user()->role_id == 1)
                            <!-- Admin Users -->
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="sidebar-btn {{ Request::is('admin/users*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }}">
                                    <span>Admin Users</span>
                                </a>
                            </li>
                        @endif
                    @endauth

                    <!-- တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.divisions.index') }}"
                            class="sidebar-btn {{ Request::is('admin/division*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }}">
                            <span>တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ</span>
                        </a>
                    </li>

                    <!-- ခရိုင်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.districts.index') }}"
                            class="sidebar-btn {{ Request::is('admin/district*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }}">
                            <span>ခရိုင်များ</span>
                        </a>
                    </li>

                    <!-- မြို့နယ်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.townships.index') }}"
                            class="sidebar-btn {{ Request::is('admin/township*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }}">
                            <span>မြို့နယ်များ</span>
                        </a>
                    </li>

                    <!-- ဘုရားစေတီပုထိုးများ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pagodas.index') }}"
                            class="sidebar-btn {{ Request::is('admin/pagoda*') ? 'sidebar-btn-active shadow-sm' : 'sidebar-btn-hover' }}">
                            <span>ဘုရားစေတီပုထိုးများ</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>

        <!-- [ညာဘက်ခြမ်း] - Content ပေါ်မယ့်နေရာ -->
        <main class="flex-grow-1 p-4 bg-light" style="min-width: 0;">
            @yield('content')
        </main>

    </div>

</body>

</html>
