@extends('components.admin-layout')
@section('content')
    {{-- Icons အတွက် FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-5" style="max-width: 700px;">

        {{-- Header Title --}}
        <div class="mb-4">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">တိုင်းဒေသကြီး/ပြည်နယ် အသစ်ထည့်ရန်</h4>
        </div>

        {{-- 💡 Bootstrap Form Card --}}
        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <!-- 1. action ကို store ပြောင်းပြီး enctype ထည့်ထားပါတယ် -->
            <form action="{{ route('admin.divisions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Input Field Group --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တိုင်းဒေသကြီး/ပြည်နယ်အမည်
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder=""
                        class="form-control py-2.5 rounded-2 @error('name') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Photo Field Group --}}
                <div class="mb-4">
                    <label for="photo" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တိုင်းဒေသကြီး/ပြည်နယ်ဓာတ်ပုံ
                    </label>
                    <!-- Input file မှာ value ပေးလို့မရပါဘူး၊ Create မို့လို့ required ထည့်ထားပါတယ် -->
                    <input type="file" name="photo" id="photo" required
                        class="form-control py-2.5 rounded-2 @error('photo') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    @error('photo')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Form Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-4">
                    <a href="{{ route('admin.divisions.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        မလုပ်တော့ပါ
                    </a>

                    <button type="submit"
                        class="btn btn-primary px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm"
                        style="background-color: #f97316; border-color: #f97316;">
                        သိမ်းဆည်းရန်
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
