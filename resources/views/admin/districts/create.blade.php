@extends('components.admin-layout')
@section('content')
    <div class="container py-5" style="max-width: 700px;">

        <div class="mb-4">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">ခရိုင်အသစ်ထည့်ရန်</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.districts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Input Field Group --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        ခရိုင်အမည်
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

                {{-- Division Name --}}
                <div class="mb-4">
                    <label for="division-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တိုင်းဒေသကြီး / ပြည်နယ်ကိုရွေးချယ်ပါ
                    </label>

                    <select name="division_id" id="division-id" required
                        class="form-select py-2.5 rounded-2 @error('division_id') is-invalid @enderror"
                        style="font-size: 0.95rem;">
                        <option value="">-- Choose Division --</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('division_id')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Form Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-4">
                    <a href="{{ route('admin.districts.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        မလုပ်တော့ပါ
                    </a>

                    <button type="submit"
                        class="btn btn-primary px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                        သိမ်းမည်
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
