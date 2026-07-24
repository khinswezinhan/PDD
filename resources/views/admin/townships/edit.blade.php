@extends('components.admin-layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-2" style="max-width: 700px;">

        <div class="mb-4">
            <h4 class="fw-bold text-dark fs-5 m-0" style="letter-spacing: -0.5px;">မြို့နယ်ပြင်ဆင်ရန်</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.townships.update', $township->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- မြို့နယ်အမည် --}}
                <div class="mb-2">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        မြို့နယ်အမည်
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $township->name) }}" required
                        class="form-control py-2.5 rounded-2 custom-orange-input @error('name') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Division Select Dropdown --}}
                <div class="mb-2">
                    <label for="division-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တိုင်းဒေသကြီး/ပြည်နယ်ရွေးချယ်ပါ
                    </label>

                    <select name="division_id" id="division-id" required
                        class="form-select py-2.5 rounded-2 custom-orange-input @error('division_id') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">
                        <option value="">-- တိုင်းဒေသကြီး/ပြည်နယ်ရွေးချယ်ပါ --</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ old('division_id', $township->district->division_id ?? '') == $division->id ? 'selected' : '' }}>
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

                {{-- District Select Dropdown --}}
                <div class="mb-2">
                    <label for="district-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        ခရိုင်ရွေးချယ်ရန်
                    </label>

                    <select name="district_id" id="district-id" required
                        class="form-select py-2.5 rounded-2 custom-orange-input @error('district_id') is-invalid @enderror"
                        style="font-size: 0.95rem; border-color: #fdba74;">
                        <option value="">-- ခရိုင်ရွေးချယ်ပါ --</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ old('district_id', $township->district_id) == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
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
                        class="btn orange-btn px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm"
                        style="background-color: #f97316; border-color: #f97316;">
                        အသစ်ပြင်ဆင်မည်
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division-id');
            const districtSelect = document.getElementById('district-id');

            divisionSelect.addEventListener('change', function() {
                const divisionId = this.value;

                // Loading ပြပြီး select box ကို ခဏ ပိတ်ထားမည်
                districtSelect.innerHTML = '<option value="">-- Loading Districts... --</option>';
                districtSelect.disabled = true;

                if (!divisionId) {
                    districtSelect.innerHTML = '<option value="">-- Choose District --</option>';
                    districtSelect.disabled = false;
                    return;
                }

                // Web.php ထဲက Route Name ကို သုံးပြီး AJAX လှမ်းခေါ်ခြင်း
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
                        districtSelect.innerHTML = '<option value="">-- Choose District --</option>';

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
