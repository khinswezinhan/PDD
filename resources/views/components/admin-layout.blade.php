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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-light m-0 p-0">

    <!-- [၁] Navbar ကို အပေါ်ဆုံးမှာ 100% အပြည့် နေရာယူစေခြင်း -->
    <header class="w-100 bg-gold border-bottom" style="position: relative; z-index: 1030;">
        @include('admin.layouts.nav')
    </header>

    <!-- [၂] Navbar အောက်ရောက်မှ Sidebar နှင့် Content ကို ဘယ်/ညာ ခွဲခြင်း -->
    <div class="d-flex" style="min-height: calc(100vh - 56px); width: 100%;">

        <!-- [ဘယ်ဘက်ခြမ်း] - Sidebar (အကျယ် 250px အသေ) -->
        <aside class="bg-white border-end" style="width: 250px; min-width: 250px; flex-shrink: 0;">
            <div class="p-3">
                <ul class="nav nav-pills flex-column gap-2">

                    <li class="nav-item">
                        <a href="{{ route('admin.divisions.index') }}"
                            class="nav-link {{ Request::is('admin/division*') ? 'bg-primary text-white' : 'text-dark' }}">
                            တိုင်းဒေသကြီးနှင့်ပြည်နယ်များ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.districts.index') }}"
                            class="nav-link {{ Request::is('admin/district*') ? 'bg-primary text-white' : 'text-dark' }}">
                            ခရိုင်များ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.townships.index') }}"
                            class="nav-link {{ Request::is('admin/township*') ? 'bg-primary text-white' : 'text-dark' }}">
                            မြို့နယ်များ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pagodas.index') }}"
                            class="nav-link {{ Request::is('admin/pagoda*') ? 'bg-primary text-white' : 'text-dark' }}">
                            ဘုရားစေတီပုထိုးများ
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- [ညာဘက်ခြမ်း] - Content ပေါ်မယ့်နေရာ -->
        <main class="flex-grow-1 p-4 bg-gray-100" style="min-width: 0;">
            @yield('content')
        </main>

    </div>

</body>

</html>
