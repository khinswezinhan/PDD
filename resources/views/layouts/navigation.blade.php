{{-- 🌟 မီနူးစာသားများကို အနက်ရောင်သို့ ပြောင်းလဲထားပါသည် --}}
<nav x-data="{ open: false, showLogin: false, activeTab: '' }" x-init="activeTab = window.location.hash ? window.location.hash : ''" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 gap-4">

            {{-- 1. Logo & Desktop Navigation --}}
            <div class="flex items-center gap-10 flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-3 decoration-none">
                    <svg class="h-10 w-10 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 2zm0 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm1.2 4.14A3.48 3.48 0 0 0 12 9a3.48 3.48 0 0 0-1.2.64L12 14l1.2-4.36zM12 15c-1.66 0-3-1.34-3-3l1.35-4.86c.15-.55.65-.94 1.23-.94s1.08.39 1.23.94L14.35 12c0 1.66-1.34 3-3 3zm-4.5 3h9l-1-2.5h-7l-1 2.5zm-2.5 3h14l-1-2.5h-12l-1 2.5z" />
                    </svg>
                    <div class="leading-tight">
                        <span class="font-bold text-xl block text-gray-900 tracking-wide">Pagoda</span>
                        <span class="text-xs text-orange-500 block font-semibold">Digital Directory</span>
                    </div>
                </a>

                <div class="hidden sm:flex items-center space-x-8 text-base">
                    {{-- Desktop Menu Item 1 --}}
                    <a href="{{ url('/#regions-pagodas') }}"
                        @click="activeTab = '#regions-pagodas'"
                        :class="activeTab === '#regions-pagodas' ? 'text-orange-500' : 'text-gray-900 hover:text-orange-500'"
                        class="transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                        တိုင်းဒေသကြီး/ပြည်နယ်ရှိဘုရားများ
                    </a>

                    {{-- Desktop Menu Item 2 --}}
                    <a href="{{ url('/#famous-pagodas') }}"
                        @click="activeTab = '#famous-pagodas'"
                        :class="activeTab === '#famous-pagodas' ? 'text-orange-500' : 'text-gray-900 hover:text-orange-500'"
                        class="transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                        တန်ခိုးကြီးဘုရားများ
                    </a>

                    {{-- Desktop Menu Item 3 --}}
                    <a href="{{ url('/#contact') }}"
                        @click="activeTab = '#contact'"
                        :class="activeTab === '#contact' ? 'text-orange-500' : 'text-gray-900 hover:text-orange-500'"
                        class="transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                        ဆက်သွယ်ရန်
                    </a>
                </div>
            </div>

            {{-- 2. Search Box, Auth Buttons & Mobile Menu Toggle --}}
            <div class="flex items-center justify-end flex-grow gap-4 min-w-0">

                {{-- Ultra-Wide Search Box --}}
                <div class="flex items-center justify-end flex-grow max-w-[1000px]">
                    <form action="#" method="GET" id="searchForm"
                        class="m-0 w-0 opacity-0 overflow-hidden transition-all duration-300 ease-in-out flex items-center w-full justify-end">
                        <div
                            class="flex items-center w-full min-w-[200px] sm:min-w-[320px] md:max-w-[540px] lg:max-w-[1000px] bg-gray-50 rounded-full px-6 py-3 border-2 border-orange-400 focus-within:border-orange-500 focus-within:ring-2 focus-within:ring-orange-500/20 shadow-sm">

                            <div class="text-gray-400 flex-shrink-0 flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>

                            <input type="text" name="search" id="searchInput" placeholder="ရှာဖွေရန်..."
                                class="ml-4 w-full text-base bg-transparent text-gray-800 p-0 border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent placeholder-gray-400"
                                style="outline: none !important; border: none !important; box-shadow: none !important;">
                        </div>
                    </form>

                    <button type="button" id="searchBtn"
                        class="p-2 text-gray-900 hover:text-orange-500 hover:bg-orange-50 rounded-full transition duration-150 focus:outline-none flex-shrink-0">
                        <svg id="searchIcon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                {{-- Desktop Auth Buttons --}}
                <div class="hidden sm:flex sm:items-center flex-shrink-0">
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm font-bold text-gray-900 hover:text-orange-500 px-3 py-2 rounded-md hover:bg-orange-50 transition decoration-none">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-sm font-bold text-red-500 hover:text-white px-3 py-2 rounded-md hover:bg-red-600 transition">Log
                                Out</button>
                        </form>
                    @else
                        {{-- Login Button (Orange Icon) --}}
                        <a href="#" @click.prevent="showLogin = true"
                            class="p-1.5 text-orange-500 hover:bg-orange-50 rounded-full transition duration-150 focus:outline-none inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-7 w-7 text-orange-500">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75 .75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75 .75 0 0 1-.437-.695Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <div class="flex items-center sm:hidden flex-shrink-0">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-900 hover:text-orange-500 hover:bg-orange-50 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Mobile Navigation Links --}}
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white border-t border-gray-100 max-h-[calc(100vh-80px)] overflow-y-auto shadow-lg">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ url('/#regions-pagodas') }}" 
                @click="activeTab = '#regions-pagodas'; open = false"
                :class="activeTab === '#regions-pagodas' ? 'border-orange-500 text-orange-500 bg-orange-50' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-orange-500'"
                class="block pl-3 pr-4 py-2.5 border-l-4 text-base font-extrabold decoration-none">တိုင်းဒေသကြီး/ပြည်နယ်ရှိဘုရားများ</a>
            
            <a href="{{ url('/#famous-pagodas') }}" 
                @click="activeTab = '#famous-pagodas'; open = false"
                :class="activeTab === '#famous-pagodas' ? 'border-orange-500 text-orange-500 bg-orange-50' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-orange-500'"
                class="block pl-3 pr-4 py-2.5 border-l-4 text-base font-extrabold decoration-none">တန်ခိုးကြီးဘုရားများ</a>
            
            <a href="{{ url('/#contact') }}" 
                @click="activeTab = '#contact'; open = false"
                :class="activeTab === '#contact' ? 'border-orange-500 text-orange-500 bg-orange-50' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-orange-500'"
                class="block pl-3 pr-4 py-2.5 border-l-4 text-base font-extrabold decoration-none">ဆက်သွယ်ရန်</a>

            @guest
                <a href="#" @click.prevent="showLogin = true; open = false"
                    class="block pl-3 pr-4 py-2.5 border-l-4 border-transparent text-base font-extrabold text-gray-900 hover:bg-orange-50 hover:text-orange-500 decoration-none">အကောင့်ဝင်ရန်
                    (Login)
                </a>
            @endguest
        </div>
    </div>

    {{-- 🌟🌟🌟 LOGIN MODAL 🌟🌟🌟 --}}
    <div x-show="showLogin" x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto px-4 py-6 sm:px-0">
        <div x-show="showLogin" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 transform transition-all backdrop-blur-sm"
            style="background-color: rgba(0, 0, 0, 0.65) !important;" @click="showLogin = false"></div>

        <div x-show="showLogin" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="bg-white shadow-2xl transform transition-all sm:w-full sm:max-w-md border border-gray-100 z-[101]"
            style="border-radius: 32px !important; overflow: hidden;">
            <div class="p-8 sm:p-10">

                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-black text-gray-900 tracking-wide">အကောင့်ဝင်ရန်</h3>
                    <button @click="showLogin = false"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-full focus:outline-none transition duration-150">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="mb-5">
                        <label for="modal_email"
                            class="block text-sm font-black text-gray-700 mb-4 pl-1">အီးမေးလ်လိပ်စာ</label>
                        <input id="modal_email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="w-full px-5 py-3.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 shadow-sm transition duration-200 font-medium placeholder-gray-400"
                            placeholder="">
                    </div>

                    <div class="mb-5">
                        <label for="modal_password"
                            class="block text-sm font-black text-gray-700 mb-4 pl-1">လျှို့ဝှက်နံပါတ်</label>
                        <input id="modal_password" type="password" name="password" required
                            class="w-full px-5 py-3.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 shadow-sm transition duration-200 font-medium placeholder-gray-400"
                            placeholder="">
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500 h-4 w-4">
                            <span class="ms-2.5 text-xs font-bold text-gray-500 select-none">မှတ်ထားရန်</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-xs font-bold text-orange-500 hover:text-orange-600 transition decoration-none"
                                href="{{ route('password.request') }}">
                                လျှို့ဝှက်နံပါတ် မေ့နေပါသလား?
                            </a>
                        @endif
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full text-white font-black py-4 px-4 text-base shadow-lg transition duration-150 focus:outline-none active:scale-[0.99]"
                            style="background-color: #f97316 !important; border-radius: 14px !important; display: block !important;">
                            အကောင့်ဝင်မည်
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBtn = document.getElementById('searchBtn');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');

        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');

        if (searchQuery && searchQuery.trim() !== "") {
            searchInput.value = searchQuery;
            openSearchBox();
        }

        function openSearchBox() {
            searchForm.classList.remove('w-0', 'opacity-0');
            searchForm.classList.add('w-full', 'md:max-w-[540px]', 'lg:max-w-[720px]', 'opacity-100', 'mr-2');
            searchBtn.classList.add('hidden');
        }

        function closeSearchBox() {
            searchForm.classList.remove('w-full', 'md:max-w-[540px]', 'lg:max-w-[720px]', 'opacity-100',
                'mr-2');
            searchForm.classList.add('w-0', 'opacity-0');
            searchBtn.classList.remove('hidden');
        }

        searchBtn.addEventListener('click', function() {
            if (searchForm.classList.contains('w-0')) {
                openSearchBox();
                setTimeout(() => searchInput.focus(), 150);
            }
        });

        document.addEventListener('click', function(event) {
            if (!searchBtn.contains(event.target) && !searchForm.contains(event.target) && !
                searchQuery) {
                closeSearchBox();
                searchInput.value = '';
            }
        });
    });
</script>