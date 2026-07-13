<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center gap-10">
                <a href="" class="flex items-center gap-3 decoration-none">
                    <svg class="h-10 w-10 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 2zm0 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm1.2 4.14A3.48 3.48 0 0 0 12 9a3.48 3.48 0 0 0-1.2.64L12 14l1.2-4.36zM12 15c-1.66 0-3-1.34-3-3l1.35-4.86c.15-.55.65-.94 1.23-.94s1.08.39 1.23.94L14.35 12c0 1.66-1.34 3-3 3zm-4.5 3h9l-1-2.5h-7l-1 2.5zm-2.5 3h14l-1-2.5h-12l-1 2.5z"/>
                    </svg>
                    <div class="leading-tight">
                        <span class="font-bold text-xl block text-gray-800 tracking-wide">Pagoda</span>
                        <span class="text-xs text-gray-500 block font-semibold">Digital Directory</span>
                    </div>
                </a>

                <div class="hidden sm:flex items-center space-x-8 text-base">
                    <a href="#regions-pagodas" class="text-gray-900 hover:text-orange-500 transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                        တိုင်းဒေသကြီး/ပြည်နယ်ရှိဘုရားများ
                    </a>
                    <a href="#famous-pagodas" class="text-gray-900 hover:text-orange-500 transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                        တန်ခိုးကြီးဘုရားများ
                    </a>
                    <a href="#contact" class="text-gray-900 hover:text-orange-500 transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                        ဆက်သွယ်ရန်
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                
                <div class="flex items-center relative">
                    <form action="#" method="GET" id="searchForm" class="m-0 max-w-0 opacity-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <input 
                            type="text" 
                            name="search" 
                            id="searchInput"
                            placeholder="ရှာဖွေရန်..." 
                            class="w-[280px] text-base bg-gray-50 text-gray-800 rounded-xl px-4 py-2.5 border-2 border-orange-500 focus:outline-none focus:border-orange-600 focus:ring-2 focus:ring-orange-600 shadow-sm"
                        >
                    </form>
                    <button type="button" id="searchBtn" class="p-2 text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-full transition duration-150 focus:outline-none">
                        <svg id="searchIcon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <svg id="closeIcon" class="h-6 w-6 text-red-500 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="hidden sm:flex sm:items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-900 hover:text-gray-600 px-3 py-2 rounded-md hover:bg-gray-50 transition decoration-none">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-800 px-3 py-2 rounded-md hover:bg-red-50 transition">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-orange-500 text-white px-5 py-2.5 rounded-md text-sm font-bold hover:bg-orange-600 shadow-sm transition duration-150 ease-in-out decoration-none">Login</a>
                    @endauth
                </div>

                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-t border-gray-200 max-h-[calc(100vh-80px)] overflow-y-auto">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="#regions-pagodas" @click="open = false" class="block pl-3 pr-4 py-2.5 border-l-4 border-transparent text-base font-extrabold text-gray-900 hover:bg-gray-100 hover:border-orange-500 hover:text-orange-500 decoration-none">တိုင်းဒေသကြီး/ပြည်နယ်ရှိဘုရားများ</a>
            <a href="#famous-pagodas" @click="open = false" class="block pl-3 pr-4 py-2.5 border-l-4 border-transparent text-base font-extrabold text-gray-900 hover:bg-gray-100 hover:border-orange-500 hover:text-orange-500 decoration-none">တန်ခိုးကြီးဘုရားများ</a>
            <a href="#contact" @click="open = false" class="block pl-3 pr-4 py-2.5 border-l-4 border-transparent text-base font-extrabold text-gray-900 hover:bg-gray-100 hover:border-orange-500 hover:text-orange-500 decoration-none">ဆက်သွယ်ရန်</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.getElementById('searchBtn');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const searchIcon = document.getElementById('searchIcon');
        const closeIcon = document.getElementById('closeIcon');

        // 🌟 URL မှာ ?search=... ပါလာရင် စာသားကို Input Box ထဲပြန်ထည့်ပြီး အကွက်ကို ဖွင့်ထားပေးမည့်အပိုင်း
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');

        if (searchQuery && searchQuery.trim() !== "") {
            searchInput.value = searchQuery; // စာသားပြန်ထည့်ပေးခြင်း
            openSearchBox(); // Box ကို ပွင့်လျက်သား လုပ်ထားခြင်း
        }

        function openSearchBox() {
            searchForm.classList.remove('max-w-0', 'opacity-0');
            searchForm.classList.add('max-w-[200px]', 'opacity-100', 'mr-1');
            searchIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        }

        function closeSearchBox() {
            searchForm.classList.remove('max-w-[200px]', 'opacity-100', 'mr-1');
            searchForm.classList.add('max-w-0', 'opacity-0');
            searchIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }

        // Icon ကို နှိပ်ရင် ဖွင့်/ပိတ် လုပ်ခြင်း
        searchBtn.addEventListener('click', function () {
            if (searchForm.classList.contains('max-w-0')) {
                openSearchBox();
                setTimeout(() => searchInput.focus(), 150);
            } else {
                // အကယ်၍ စာရိုက်ထားပြီး ပိတ်ရင် စာကိုရှင်းပြီး Page ကို မူလအတိုင်းပြန်ခေါ်ရန်
                if (searchQuery) {
                    window.location.href = window.location.pathname;
                } else {
                    closeSearchBox();
                }
            }
        });

        // Search Box အပြင်ဘက်ကို နှိပ်ရင် အလိုအလျောက် ပြန်ပိတ်ရန် (စာရိုက်မထားမှသာ)
        document.addEventListener('click', function (event) {
            if (!searchBtn.contains(event.target) && !searchForm.contains(event.target) && !searchQuery) {
                closeSearchBox();
            }
        });
    });
</script>