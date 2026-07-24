<x-app-layout>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    {{-- 🌟 Navigation Bar အမြင့်ကြီးနှင့် လွတ်စေရန် pt-36 sm:pt-40 သို့ ထပ်မံတိုးမြှင့်လိုက်သည် --}}
    <div class="min-h-screen bg-gray-50 pt-36 sm:pt-40 pb-12 sm:pb-16">
        <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12">

            

            {{-- 🏛️ Main Content Container --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="h-64 sm:h-96 w-full bg-gray-100 relative overflow-hidden">
                    @if ($pagoda->photo)
                        <img src="{{ asset($pagoda->photo) }}" alt="{{ $pagoda->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <img src="https://placehold.co/1200x600/f3f4f6/0891b2?text={{ urlencode($pagoda->name) }}"
                            alt="{{ $pagoda->name }}" class="w-full h-full object-cover">
                    @endif

                    @if ($pagoda->status === 'famous')
                        <div
                            class="absolute top-4 right-4 bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                            ⭐ တန်ခိုးကြီးဘုရား
                        </div>
                    @endif
                </div>

                <div class="p-6 sm:p-10">
                    <div class="border-b border-gray-100 pb-6 mb-6">
                        <h1 class="text-2xl sm:text-3xl font-black text-gray-950 tracking-tight leading-tight">
                            {{ $pagoda->name }}
                        </h1>

                        <div class="mt-3 flex flex-wrap items-center gap-2 text-xs font-semibold text-gray-500">
                            <span class="inline-flex items-center text-orange-500 bg-orange-50 px-2.5 py-1 rounded-md">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                တည်နေရာ:
                            </span>

                            @if ($pagoda->township)
                                <span class="bg-gray-100 px-2.5 py-1 rounded-md">{{ $pagoda->township->name }}
                                    မြို့နယ်</span>
                            @endif

                            @if ($pagoda->township && $pagoda->township->district)
                                <span class="text-gray-300">/</span>
                                <span class="bg-gray-100 px-2.5 py-1 rounded-md">{{ $pagoda->township->district->name }}
                                    ခရိုင်</span>
                            @endif

                            @if ($pagoda->township && $pagoda->township->district && $pagoda->township->district->division)
                                <span class="text-gray-300">/</span>
                                <a href="{{ route('division.show', $pagoda->township->district->division->id) }}"
                                    class="bg-cyan-50 text-cyan-600 hover:bg-cyan-100 px-2.5 py-1 rounded-md transition decoration-none">
                                    {{ $pagoda->township->district->division->name }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            သမိုင်းအကျဉ်းနှင့် အချက်အလက်များ
                        </h2>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line prose max-w-none">
                            {!! nl2br(e($pagoda->history)) !!}
                        </div>
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
