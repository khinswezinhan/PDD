@extends('components.admin-layout')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="pt-2 pb-8">
        {{-- max-w-7xl အစား max-w-2xl ပြောင်းထားသဖြင့် Card Size ပိုသေးပြီး အလယ်တည့်တည့် ရောက်သွားပါမည် --}}
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- p-4 sm:p-6 လို့ ပြောင်းပြီး Card အတွင်း အကွာအဝေးကိုလည်း လှပအောင် ညှိထားသည် --}}
            <div class="p-4 sm:p-6 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-6 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-6 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection
