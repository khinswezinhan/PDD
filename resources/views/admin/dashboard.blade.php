<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- သင့်ရဲ့ Admin Dashboard အနှစ်ချုပ် Content များ ဒီမှာရေးပါ -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{ __('Welcome to Admin Dashboard!') }}
            </div>
        </div>
    </div>
</x-layouts.admin>
