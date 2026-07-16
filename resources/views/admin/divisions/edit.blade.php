@extends('components.admin-layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-5" style="max-width: 700px;">

        <div class="mb-4">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">တိုင်းဒေသကြီး/ပြည်နယ် ပြင်ရန်</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            {{-- 💡 action ကို Dynamic ပြောင်းလဲထားပြီး enctype စာလုံးပေါင်းကို အမှန်ပြင်ထားသည် --}}
            <form action="{{ route('admin.divisions.update', $division->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Input Field Group --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တိုင်းဒေသကြီး/ပြည်နယ်အမည်
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $division->name) }}" required
                        placeholder="" class="form-control py-2.5 rounded-2 @error('name') is-invalid @enderror"
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
                        တိုင်းဒေသကြီး/ပြည်နယ်ဓာတ်ပုံ (ပြင်လိုမှသာ ပုံအသစ်ရွေးပါ)
                    </label>

                    {{-- လက်ရှိရှိနေတဲ့ ပုံဟောင်းကို ပြပေးထားတဲ့အပိုင်း --}}
                    @if ($division->photo)
                        <div class="mb-2">
                            <img src="{{ asset('images/' . $division->photo) }}" alt="Current Photo" class="img-thumbnail"
                                style="max-height: 100px;">
                        </div>
                    @endif

                    <input type="file" name="photo" id="photo"
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
                        class="btn btn-primary px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                        အသစ်သိမ်းမည်
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
