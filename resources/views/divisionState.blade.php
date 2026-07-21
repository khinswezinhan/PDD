<x-app-layout>
    <style>
        html { scroll-behavior: smooth; }
    </style>

    {{-- 🌟 Navigation Bar အမြင့်ကြီးနှင့် လွတ်စေရန် pt-36 sm:pt-40 သို့ ထပ်မံတိုးမြှင့်လိုက်သည် --}}
    <div class="min-h-screen bg-gray-50 pt-36 sm:pt-40 pb-12 sm:pb-16">
        <div class="max-w-7xl mx-auto px-3 sm:px-8 lg:px-12">
            
           
            

            
            <div class="border-b border-gray-200 pb-8 mb-10 flex flex-col items-center justify-center text-center gap-4">
                <div class="space-y-3">
                    <h1 class="text-3xl sm:text-4xl font-black text-gray-950 tracking-tight leading-tight">
                         {{ $division->name }}ရှိ ဘုရားများ
                    </h1>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed max-w-2xl mx-auto">
                        {{ $division->name }}အတွင်းရှိ တန်ခိုးကြီးဘုရားများနှင့် သမိုင်းဝင်စေတီပုထိုးများ စာရင်း
                    </p>
                </div>
            </div>

            {{-- 🌟 ဘုရားများပြသရန် Grid Layout --}}
            @if($pagodas->isEmpty())
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100 max-w-xl mx-auto my-10">
                    <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto text-amber-500 mb-4 shadow-inner">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">ဘုရားစာရင်း မရှိသေးပါ</h3>
                    <p class="mt-2 text-sm text-gray-400 font-medium px-6 leading-relaxed">
                        ယခု တိုင်းဒေသကြီး/ပြည်နယ်အတွက် ဘုရားအချက်အလက်များကို Database ထဲတွင် ထည့်သွင်းထားခြင်း မရှိသေးပါဗျာ။
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($pagodas as $pagoda)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between text-sm group">
                            <div>
                                <div class="h-40 bg-gray-200 relative overflow-hidden">
                                    <a href="{{ route('pagoda.show', $pagoda->id) }}" class="block w-full h-full">
                                        @if($pagoda->photo)
                                            <img src="{{ asset($pagoda->photo) }}" alt="{{ $pagoda->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @else
                                            <img src="https://placehold.co/600x400/f3f4f6/0891b2?text={{ urlencode($pagoda->name) }}" alt="{{ $pagoda->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @endif
                                    </a>
                                </div>

                                <div class="p-4">
                                    <h3 class="text-base font-bold text-gray-900 leading-snug">
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
                                <a href="{{ route('pagoda.show', $pagoda->id) }}" class="inline-block text-cyan-600 font-semibold hover:text-cyan-700 text-xs decoration-none">
                                    အသေးစိတ်ဖတ်ရန် →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>