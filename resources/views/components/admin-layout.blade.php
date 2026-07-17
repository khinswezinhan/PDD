<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NLP-Based Semantics Search Engine</title>

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

            /* မနှိပ်ထားတဲ့ ခလုတ်တွေကို မီးခိုးနုရောင် background အမြဲပေးထားမယ် */
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #e9ecef;
        }

        /* ၂။ Hover လုပ်တဲ့အချိန် transition လှလှလေး ပြောင်းလဲခြင်း */
        .sidebar-btn-hover:hover {
            background-color: #e9ecef !important;
            color: #0d6efd !important;
            border-color: #dee2e6;
            transform: translateX(4px);
        }

        /* ၃။ စာသားရှည်လည်း အောက်တန်းမကျသွားစေရန် (တစ်တန်းတည်း အမြဲပေါ်စေပြီး ဆံ့သလောက်ပြသရန်) */
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
    </style>

</head>

<body class="font-sans antialiased bg-light m-0 p-0">

    <!-- [၁] Navbar ကို အပေါ်ဆုံးမှာ 100% အပြည့် နေရာယူစေခြင်း -->
    <header class="w-100 bg-gold border-bottom" style="position: relative; z-index: 1030;">
        @include('admin.layouts.nav')
    </header>

    <!-- [၂] Navbar အောက်ရောက်မှ Sidebar နှင့် Content ကို ဘယ်/ညာ ခွဲခြင်း -->
    <!-- `main-wrapper` class ကို d-flex ထဲမှာ ထည့်ပေးထားပါတယ် -->
    <div class="d-flex main-wrapper" style="min-height: calc(100vh - 56px); width: 100%;">

        <!-- [ဘယ်ဘက်ခြမ်း] - Sidebar (Laptop မှာ 280px အသေသတ်မှတ်ပြီး Phone မှာ 100% ဖြစ်သွားပါမယ်) -->
        <aside class="bg-white border-end sidebar-container" style="width: 280px; min-width: 280px; flex-shrink: 0;">
            <div class="p-3">
                <!-- `sidebar-menu` class ထည့်ပေးထားပါတယ် -->
                <ul class="nav flex-column gap-2 sidebar-menu">

                    @auth
                        @if (auth()->user()->role_id == 1)
                            <!-- Admin Users -->
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="sidebar-btn {{ Request::is('admin/users*') ? 'bg-primary text-white shadow-sm border-primary' : 'sidebar-btn-hover' }}">
                                    <span>Admin Users</span>
                                </a>
                            </li>
                        @endif
                    @endauth

                    <!-- တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.divisions.index') }}"
                            class="sidebar-btn {{ Request::is('admin/division*') ? 'bg-primary text-white shadow-sm border-primary' : 'sidebar-btn-hover' }}">
                            <span>တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ</span>
                        </a>
                    </li>

                    <!-- ခရိုင်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.districts.index') }}"
                            class="sidebar-btn {{ Request::is('admin/district*') ? 'bg-primary text-white shadow-sm border-primary' : 'sidebar-btn-hover' }}">
                            <span>ခရိုင်များ</span>
                        </a>
                    </li>

                    <!-- မြို့နယ်များ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.townships.index') }}"
                            class="sidebar-btn {{ Request::is('admin/township*') ? 'bg-primary text-white shadow-sm border-primary' : 'sidebar-btn-hover' }}">
                            <span>မြို့နယ်များ</span>
                        </a>
                    </li>

                    <!-- ဘုရားစေတီပုထိုးများ -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pagodas.index') }}"
                            class="sidebar-btn {{ Request::is('admin/pagoda*') ? 'bg-primary text-white shadow-sm border-primary' : 'sidebar-btn-hover' }}">
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
