<x-app-layout>
    <style>
        html {
            scroll-behavior: smooth;
        }
        /* Pagination နှင့် ခေါင်းစဉ်များ ကွက်တိဖြစ်စေမည့် Style */
        .custom-pagination-wrapper {
            margin-top: 2rem !important;
            padding-top: 1rem !important;
            padding-bottom: 0rem !important;
        }

        .custom-pagination-wrapper nav {
            margin-top: 0 !important;
        }

        .custom-pagination-wrapper nav svg {
            display: inline-block;
        }
        
        /* Pagination Links နှင့် Buttons များအတွက် ပုံမှန်အရောင် */
        .custom-pagination-wrapper nav a,
        .custom-pagination-wrapper nav button,
        .custom-pagination-wrapper nav span:not([aria-current="page"]):not([aria-disabled="true"]) span,
        .famous-pagination-wrapper nav a,
        .famous-pagination-wrapper nav button,
        .famous-pagination-wrapper nav span:not([aria-current="page"]):not([aria-disabled="true"]) span {
            color: #1f2937 !important;        
            background-color: #ffffff !important;  
            border-color: #d1d5db !important;      
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        /* 🌟 Active Page များကို လိမ္မော်ရောင်အဖြစ် သတ်မှတ်ခြင်း */
        .custom-pagination-wrapper nav [aria-current="page"] span,
        .custom-pagination-wrapper nav [aria-current="page"] button,
        .famous-pagination-wrapper nav [aria-current="page"] span,
        .famous-pagination-wrapper nav [aria-current="page"] button,
        .custom-pagination-wrapper nav span.bg-blue-600,
        .famous-pagination-wrapper nav span.bg-blue-600 {
            background-color: #f97316 !important;
            border-color: #f97316 !important;
            color: #ffffff !important;
        }

        .custom-pagination-wrapper nav a:hover,
        .custom-pagination-wrapper nav button:hover,
        .famous-pagination-wrapper nav a:hover,
        .famous-pagination-wrapper nav button:hover {
            background-color: #fff7ed !important;
            color: #ea580c !important;
            border-color: #fdba74 !important;
        }

        /* မနှိပ်နိုင်သေးသော Disabled ခလုတ်များ (Previous / Next) အတွက် အရောင် */
        .custom-pagination-wrapper nav span[aria-disabled="true"] span,
        .famous-pagination-wrapper nav span[aria-disabled="true"] span,
        .custom-pagination-wrapper nav span[aria-disabled="true"] button,
        .famous-pagination-wrapper nav span[aria-disabled="true"] button {
            color: #9ca3af !important;
            background-color: #f9fafb !important;
            border-color: #e5e7eb !important;
            opacity: 1 !important;
        }
    </style>

    {{-- Slider Section --}}
    <div class="pt-20 w-full"> 
        <div x-data="{ 
                activeSlide: 1, 
                slides: [
                    { id: 1, title: 'Buddhism', subtitle: 'And Meditation', desc: 'For The Modern World', image: '{{ asset('images/home1.png') }}' },
                    { id: 2, title: 'Peace & Mind', subtitle: 'Find Inner Peace', desc: 'Discover the path of mindfulness and tranquility.', image: '{{ asset('images/home2.png') }}' },
                    { id: 3, title: 'Digital Directory', subtitle: 'Explore Pagodas', desc: 'Locate famous pagodas across states and divisions easily.', image: '{{ asset('images/home3.png') }}' }
                ],
                next() { this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 },
                prev() { this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1 }
               }" 
             x-init="setInterval(() => next(), 5000)" 
             class="relative bg-gray-950 h-[450px] sm:h-[500px] md:h-[550px] lg:h-[600px] overflow-hidden shadow-sm w-full">

            <template x-for="slide in slides" :key="slide.id">
                <div x-show="activeSlide === slide.id" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 transform scale-102"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">

                    <img :src="slide.image" class="absolute inset-0 w-full h-full object-cover object-center"
                        alt="Pagoda Slider Image">
                    <div class="absolute inset-0 bg-black/40"></div>

                    <div
                        class="absolute inset-0 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 h-full flex flex-col justify-center items-center sm:items-start z-10">
                        <div class="max-w-xl text-center sm:text-left text-white">
                            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight leading-tight uppercase drop-shadow-lg"
                                x-text="slide.title"></h1>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-orange-400 mt-1 drop-shadow-lg"
                                x-text="slide.subtitle"></h2>
                            <p class="mt-3 text-base sm:text-lg text-gray-100 font-semibold leading-relaxed drop-shadow-md"
                                x-text="slide.desc"></p>
                        </div>
                    </div>
                </div>
            </template>

            <button @click="prev()"
                class="hidden sm:flex absolute left-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition focus:outline-none z-20 items-center justify-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="next()"
                class="hidden sm:flex absolute right-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition focus:outline-none z-20 items-center justify-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-2.5 z-20">
                <template x-for="slide in slides" :key="slide.id">
                    <button @click="activeSlide = slide.id"
                        :class="activeSlide === slide.id ? 'bg-orange-500 w-7' : 'bg-white/40 w-2.5'"
                        class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"></button>
                </template>
            </div>
        </div>
    </div>

    {{-- တိုင်းဒေသကြီး/ပြည်နယ်ရှိဘုရားများ ကဏ္ဍ --}}
    <section id="regions-pagodas" class="max-w-7xl mx-auto pt-8 pb-6 scroll-mt-24">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-orange-500 tracking-tight">တိုင်းဒေသကြီး၊ ပြည်နယ်ရှိဘုရားများ</h2>
            <p class="mt-2 text-sm text-gray-500">မြန်မာနိုင်ငံအနှံ့အပြားရှိ တိုင်းဒေသကြီးနှင့် ပြည်နယ်အလိုက် စေတီပုထိုးများ</p>
        </div>

        {{-- AJAX Container for Regions --}}
        <div id="regions-ajax-container">
            <div class="px-6 sm:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($divisions as $division)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between text-sm">
                        <div>
                            <a href="{{ route('division.show', $division->id) }}"
                                class="block h-40 bg-gray-100 relative overflow-hidden">
                                <img src="{{ asset($division->photo) }}" alt="{{ $division->photo }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            </a>

                            <div class="p-4">
                                <h3 class="text-base font-bold text-gray-900 leading-snug mb-1">
                                    <a href="{{ route('division.show', $division->id) }}"
                                        class="text-gray-900 hover:text-orange-500 transition decoration-none">
                                        {{ $division->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    {{ $division->name }} အတွင်းရှိ သမိုင်းဝင် တန်ခိုးကြီးဘုရားများ စာရင်း။
                                </p>
                            </div>
                        </div>

                        <div class="px-4 pb-4 pt-0">
                            <a href="{{ route('division.show', $division->id) }}"
                                class="inline-flex items-center text-xs font-semibold text-orange-600 hover:text-orange-600 transition decoration-none">
                                အသေးစိတ်ကြည့်ရန်
                                <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12 text-gray-400 text-sm">
                        တိုင်းဒေသကြီး ဒေတာ မရှိသေးပါ။
                    </div>
                @endforelse
            </div>

            {{-- Regions Pagination --}}
            <div class="px-6 sm:px-8 custom-pagination-wrapper">
                {{ $divisions->links() }}
            </div>
        </div>
    </section>

    {{-- ထင်ရှားသော ဘုရားများ ကဏ္ဍ --}}
    <section id="famous-pagodas" class="max-w-7xl mx-auto pt-6 pb-16 scroll-mt-24 border-t border-gray-100">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold tracking-tight">
                <a href="{{ url('/#famous-pagodas') }}" class="text-orange-500 hover:text-orange-600 transition duration-150 ease-in-out font-extrabold decoration-none whitespace-nowrap">
                    တန်ခိုးကြီးဘုရားများ
                </a>
            </h2>
            <p class="mt-2 text-sm text-gray-500">မြန်မာနိုင်ငံတစ်ဝန်းရှိ တန်ခိုးကြီး ထင်ရှားသော စေတီပုထိုးများ</p>
        </div>

        {{-- AJAX Container for Famous Pagodas --}}
        <div id="famous-ajax-container">
            <div class="px-6 sm:px-8 grid grid-cols-1 sm:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @forelse($famousPagodas as $pagoda)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between text-sm group">
                        <div>
                            <div class="h-40 bg-gray-200 relative overflow-hidden">
                                <a href="{{ route('pagoda.show', $pagoda->id) }}" class="block w-full h-full">
                                    @if($pagoda->photo)
                                        <img src="{{ asset($pagoda->photo) }}" 
                                             alt="{{ $pagoda->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <img src="https://placehold.co/600x400/f3f4f6/0891b2?text=Pagoda" 
                                             alt="{{ $pagoda->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @endif
                                </a>
                            </div>

                            <div class="p-4">
                                <h3 class="text-base font-bold text-gray-900 leading-snug">
                                    {{-- 🌟 ဘုရားနာမည် hover လုပ်လျှင် လိမ္မော်ရောင်ဖြစ်ရန် hover:text-orange-500 ပြောင်းထားပါသည် --}}
                                    <a href="{{ route('pagoda.show', $pagoda->id) }}" class="text-gray-900 hover:text-orange-500 transition decoration-none">
                                        {{ $pagoda->name }}
                                    </a>
                                </h3>
                                <p class="mt-2 text-gray-500 text-xs leading-relaxed">
                                    {{ Str::limit($pagoda->history, 80, '...') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="px-4 pb-4 pt-0">
                            {{-- 🌟 အသေးစိတ်ဖတ်ရန် hover လုပ်လျှင် လိမ္မော်ရောင်ဖြစ်ရန် hover:text-orange-500 ပြောင်းထားပါသည် --}}
                            <a href="{{ route('pagoda.show', $pagoda->id) }}" class="inline-block text-orange-600 font-semibold hover:text-orange-500 text-xs decoration-none">
                                အသေးစိတ်ဖတ်ရန် →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12 text-gray-400 text-sm">
                        ထင်ရှားသော စေတီပုထိုးများ ဒေတာ မရှိသေးပါ။
                    </div>
                @endforelse
            </div>

            {{-- Famous Pagodas Pagination --}}
            <div class="px-6 sm:px-8 custom-pagination-wrapper famous-pagination-wrapper">
                {{ $famousPagodas->links() }}
            </div>
        </div>
    </section>

    {{-- ဆက်သွယ်ရန် --}}
    <section id="contact" class="py-16 scroll-mt-24 bg-orange-50 border-t border-orange-100 text-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">ဆက်သွယ်ရန်</h2>
                <p class="mt-3 text-lg text-gray-600">မေးမြန်းလိုသည်များရှိပါက အောက်ပါအတိုင်း ဆက်သွယ်နိုင်ပါသည်။</p>
            </div>

            <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-orange-200 text-center">
                <p class="text-gray-700 font-medium mb-4"> ကွန်ပျူတာတက္ကသိုလ်(ပြည်)</p>
                <p class="text-gray-700 font-medium mb-4">ဖုန်းနံပါတ်: 09-423676551</p>
                <p class="text-gray-700 font-medium">အီးမေးလ်: info@pagodadirectory.com</p>
            </div>
        </div>
    </section>

    {{-- AJAX Script for Pagination with Login Form Shield --}}
    <script>
        document.addEventListener('click', function(e) {
            const link = e.target.closest('.custom-pagination-wrapper a');

            if (link) {
                e.preventDefault();
                const url = link.getAttribute('href');
                
                if (!url || url.includes('login')) {
                    window.location.href = url;
                    return;
                }

                const isFamous = link.closest('#famous-ajax-container') !== null;

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (response.redirected && response.url.includes('login')) {
                        window.location.href = response.url;
                        return;
                    }
                    return response.text();
                })
                .then(html => {
                    if (!html) return;

                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    if (doc.querySelector('form input[name="_token"]') && doc.querySelector('input[type="password"]')) {
                        window.location.reload();
                        return;
                    }

                    if (isFamous) {
                        const newContent = doc.querySelector('#famous-ajax-container');
                        const oldContent = document.querySelector('#famous-ajax-container');

                        if (newContent && oldContent) {
                            oldContent.innerHTML = newContent.innerHTML;
                            document.querySelector('#famous-pagodas').scrollIntoView({ behavior: 'smooth' });
                        }
                    } else {
                        const newContent = doc.querySelector('#regions-ajax-container');
                        const oldContent = document.querySelector('#regions-ajax-container');

                        if (newContent && oldContent) {
                            oldContent.innerHTML = newContent.innerHTML;
                            document.querySelector('#regions-pagodas').scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                })
                .catch(error => {
                    console.warn('Error fetching pagination:', error);
                    window.location.href = url;
                });
            }
        });
    </script>
</x-app-layout>