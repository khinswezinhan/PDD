@extends('components.admin-layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-2" style="max-width: 700px;">

        <div class="mb-4">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">မြို့နယ်အသစ်ထည့်ရန်</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.townships.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Input Field Group --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        မြို့နယ်အမည်
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

                {{-- Division Name (အရင်ရွေးခိုင်းပါမယ်) --}}
                <div class="mb-4">
                    <label for="division-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တိုင်းဒေသကြီး/ပြည်နယ်ရွေးချယ်ရန်
                    </label>

                    <select name="division_id" id="division-id" required
                        class="form-select py-2.5 rounded-2 @error('division_id') is-invalid @enderror"
                        style="font-size: 0.95rem;">
                        <option value="">-- တိုင်းဒေသကြီး/ပြည်နယ်ရွေးချယ်ပါ --</option>
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

                {{-- District Name (Division ပေါ်မူတည်ပြီး Dynamic ပြောင်းလဲပါမယ်) --}}
                <div class="mb-4">
                    <label for="district-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        ခရိုင်ရွေးချယ်ရန်
                    </label>

                    <select name="district_id" id="district-id" required
                        class="form-select py-2.5 rounded-2 @error('district_id') is-invalid @enderror"
                        style="font-size: 0.95rem;">
                        <option value="">-- ခရိုင်ရွေးချယ်ပါ --</option>
                        {{-- ဥပမာ Validation error ပြန်တက်လာရင် ယခင်ရွေးထားဖူးတဲ့ District ကို ပြန်ပြဖို့ --}}
                        @if (old('district_id'))
                            @foreach ($districts as $district)
                                @if ($district->division_id == old('division_id'))
                                    <option value="{{ $district->id }}"
                                        {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>

                    @error('district_id')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Form Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-4">
                    <a href="{{ route('admin.townships.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        မလုပ်တော့ပါ
                    </a>

                    <button type="submit"
                        class="btn text-white px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm orange-btn"
                        style="background-color: #f97316; border-color: #f97316;">
                        သိမ်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Division ရွေးရင် သက်ဆိုင်ရာ District ပဲ ပေါ်လာအောင် လုပ်ပေးမည့် Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division-id');
            const districtSelect = document.getElementById('district-id');

            divisionSelect.addEventListener('change', function() {
                const divisionId = this.value;

                // ခဏ Loading ပြထားပြီး select box ကို ပိတ်ထားမယ်
                districtSelect.innerHTML = '<option value="">-- Loading Districts... --</option>';
                districtSelect.disabled = true;

                if (!divisionId) {
                    districtSelect.innerHTML = '<option value="">-- ခရိုင်ရွေးချယ်ပါ --</option>';
                    districtSelect.disabled = false;
                    return;
                }

                // သင်ပေးထားတဲ့ Route Name 'admin.get-districts-by-division' ကို သုံးထားပါတယ်
                let url = "{{ route('admin.get-districts-by-division', ':id') }}";
                url = url.replace(':id', divisionId);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Server error: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">-- ခရိုင်ရွေးချယ်ပါ --</option>';

                        if (data.length === 0) {
                            districtSelect.innerHTML =
                                '<option value="">-- No District Found --</option>';
                        } else {
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.name;
                                districtSelect.appendChild(option);
                            });
                        }

                        districtSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('AJAX Error:', error);
                        districtSelect.innerHTML =
                            '<option value="">-- Error Loading Districts --</option>';
                        districtSelect.disabled = false;
                    });
            });
        });
    </script>
@endsection
