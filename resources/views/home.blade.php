<x-app-layout>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

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
                <div x-show="activeSlide === slide.id" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 transform scale-102"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 w-full h-full">
                    
                    <img :src="slide.image" class="absolute inset-0 w-full h-full object-cover object-center" alt="Pagoda Slider Image">
                    <div class="absolute inset-0 bg-black/40"></div>

                    <div class="absolute inset-0 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 h-full flex flex-col justify-center items-center sm:items-start z-10">
                        <div class="max-w-xl text-center sm:text-left text-white">
                            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight leading-tight uppercase drop-shadow-lg" x-text="slide.title"></h1>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-orange-400 mt-1 drop-shadow-lg" x-text="slide.subtitle"></h2>
                            <p class="mt-3 text-base sm:text-lg text-gray-100 font-semibold leading-relaxed drop-shadow-md" x-text="slide.desc"></p>
                            
                            <div class="mt-7 flex justify-center sm:justify-start">
                                <a href="#" class="inline-block w-full sm:w-auto text-center px-8 py-3.5 text-sm sm:text-base font-bold rounded-full text-white bg-cyan-600 hover:bg-cyan-700 shadow-xl transition duration-150 transform hover:-translate-y-0.5 tracking-wider uppercase decoration-none">
                                    Join Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <button @click="prev()" class="hidden sm:flex absolute left-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition focus:outline-none z-20 items-center justify-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="next()" class="hidden sm:flex absolute right-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition focus:outline-none z-20 items-center justify-center">
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

    <section id="regions-pagodas" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-24">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">တိုင်းဒေသကြီး/ပြည်နယ်ရှိဘုရားများ</h2>
            <p class="mt-3 text-lg text-gray-500">မြန်မာနိုင်ငံအနှံ့အပြားရှိ တိုင်းဒေသကြီးနှင့် ပြည်နယ်အလိုက် စေတီပုထိုးများ</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="h-48 bg-gray-200 relative">
                    <img src="https://images.unsplash.com/photo-1543731068-7e0f5beff43a?q=80&w=500" class="w-full h-full object-cover" alt="ရန်ကုန်တိုင်း">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900">ရန်ကုန်တိုင်းဒေသကြီးရှိဘုရားများ</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">ရွှေတိဂုံစေတီတော်၊ ဆူးလေစေတီတော် အပါအဝင် ရန်ကုန်တိုင်းအတွင်းရှိ တန်ခိုးကြီးဘုရားများ။</p>
                    <a href="#" class="mt-4 inline-block text-cyan-600 font-semibold hover:text-cyan-700 text-sm">ဝင်ရောက်ကြည့်ရှုရန် →</a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="h-48 bg-gray-200 relative">
                    <img src="https://images.unsplash.com/photo-1580136608079-72029d0de130?q=80&w=500" class="w-full h-full object-cover" alt="မန္တလေးတိုင်း">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900">မန္တလေးတိုင်းဒေသကြီးရှိဘုရားများ</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">မဟာမုနိရုပ်ပွားတော်မြတ်ကြီး၊ ကုသိုလ်တော်ဘုရား အပါအဝင် မန္တလေးတိုင်းအတွင်းရှိ ဘုရားများ။</p>
                    <a href="#" class="mt-4 inline-block text-cyan-600 font-semibold hover:text-cyan-700 text-sm">ဝင်ရောက်ကြည့်ရှုရန် →</a>
                </div>
            </div>

        </div>
    </section>

    <section id="famous-pagodas" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-24 border-t border-gray-100">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">ထင်ရှားသော ဘုရားများ</h2>
            <p class="mt-3 text-lg text-gray-500">မြန်မာနိုင်ငံတစ်ဝန်းရှိ တန်ခိုးကြီး ထင်ရှားသော စေတီပုထိုးများ</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="h-48 bg-gray-200 relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900">ရွှေတိဂုံစေတီတော်</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">ရန်ကုန်မြို့တွင် တည်ရှိပြီး ကမ္ဘာ့အံ့ဖွယ် စေတီတော်ကြီး တစ်ဆူ ဖြစ်ပါသည်။</p>
                    <a href="#" class="mt-4 inline-block text-cyan-600 font-semibold hover:text-cyan-700 text-sm">အသေးစိတ်ဖတ်ရန် →</a>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="bg-gray-50 py-16 scroll-mt-24 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">ဆက်သွယ်ရန်</h2>
                <p class="mt-3 text-lg text-gray-500">မေးမြန်းလိုသည်များရှိပါက အောက်ပါအတိုင်း ဆက်သွယ်နိုင်ပါသည်။</p>
            </div>
            
            <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
                <p class="text-gray-700 font-medium mb-4">📍 လိပ်စာ: ရန်ကုန်မြို့၊ မြန်မာနိုင်ငံ။</p>
                <p class="text-gray-700 font-medium mb-4">📞 ဖုန်းနံပါတ်: 09-123456789</p>
                <p class="text-gray-700 font-medium">✉️ အီးမေးလ်: info@pagodadirectory.com</p>
            </div>
        </div>
    </section>
</x-app-layout>