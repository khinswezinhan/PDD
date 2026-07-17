@extends('components.admin-layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-5" style="max-width: 800px;">

        <div class="mb-4 d-flex align-items-center gap-2">
            <h4 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">ဘုရားစေတီပုထိုးအသစ် ထည့်သွင်းရန်</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.pagodas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        စေတီပုထိုးတော်ဘွဲ့အမည် <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        placeholder="ဥပမာ - ရွှေတိဂုံစေတီတော်မြတ်ကြီး"
                        class="form-control py-2.5 rounded-2 @error('name') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="division-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                            တိုင်းဒေသကြီး / ပြည်နယ် <span class="text-danger">*</span>
                        </label>
                        <select id="division-id" name="division_id" required
                            class="form-select py-2.5 rounded-2 @error('division_id') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                            <option value="">-- ရွေးချယ်ရန် --</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('division_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="district-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                            ခရိုင် ရွေးချယ်ရန် <span class="text-danger">*</span>
                        </label>
                        <select id="district-id" name="district_id" required disabled
                            class="form-select py-2.5 rounded-2 @error('district_id') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                            <option value="">-- တိုင်းဒေသကြီးအရင်ရွေးပါ --</option>
                        </select>
                        @error('district_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="township-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                            မြို့နယ် ရွေးချယ်ရန် <span class="text-danger">*</span>
                        </label>
                        <select id="township-id" name="township_id" required disabled
                            class="form-select py-2.5 rounded-2 @error('township_id') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                            <option value="">-- ခရိုင်အရင်ရွေးပါ --</option>
                        </select>
                        @error('township_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="photo" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        စေတီတော်ဓာတ်ပုံ
                    </label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="form-control py-2 rounded-2 @error('photo') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    <!-- Live Image Preview Wrapper -->
                    <div id="image-preview-wrapper" class="mt-3 d-none">
                        <span class="d-block small text-muted mb-2">ရွေးချယ်ထားသော ပုံရိပ်နမူနာ -</span>
                        <img id="image-preview" src="#" alt="Preview" class="img-thumbnail shadow-sm"
                            style="max-height: 180px; object-fit: cover;">
                    </div>

                    @error('photo')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="website" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        ဝဘ်ဆိုက်လင့်ခ်
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-secondary border-end-0"><i
                                class="fas fa-globe"></i></span>
                        <input type="url" name="website" id="website" value="{{ old('website') }}"
                            placeholder="https://example.com"
                            class="form-control py-2.5 rounded-end-2 @error('website') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                    </div>
                    @error('website')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- မြေပုံတည်နေရာလင့်ခ် (Google Map Link) - အသစ်ထည့်သွင်းထားသော နေရာ -->
                <div class="mb-4">
                    <label for="map_link" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        မြေပုံတည်နေရာလင့်ခ် (Google Map Link) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-secondary border-end-0"><i
                                class="fas fa-map-marker-alt"></i></span>
                        <input type="url" name="map_link" id="map_link" value="{{ old('map_link') }}" required
                            placeholder="https://maps.app.goo.gl/..."
                            class="form-control py-2.5 rounded-end-2 @error('map_link') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                    </div>
                    @error('map_link')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တည်နေရာလိပ်စာအပြည့်အစုံ (Address) <span class="text-danger">*</span>
                    </label>
                    <textarea name="address" id="address" rows="3" required placeholder=""
                        class="form-control rounded-2 @error('address') is-invalid @enderror" style="font-size: 0.95rem; resize: none;">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="history" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        စေတီတော်သမိုင်းအကျဉ်း <span class="text-danger">*</span>
                    </label>
                    <textarea name="history" id="history" rows="5" required placeholder=""
                        class="form-control rounded-2 @error('history') is-invalid @enderror" style="font-size: 0.95rem;">{{ old('history') }}</textarea>
                    @error('history')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status:</label><br>

                    <input type="radio" name="status" value="famous" id="famous"
                        {{ old('status') == 'famous' ? 'checked' : '' }}>
                    <label for="famous">Famous</label>

                    <input type="radio" name="status" value="normal" id="normal"
                        {{ old('status') == 'normal' ? 'checked' : '' }}>
                    <label for="normal">Normal</label>

                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-4">
                    <a href="{{ route('admin.pagodas.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="btn btn-primary px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="fas fa-save"></i> သိမ်းဆည်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division-id');
            const districtSelect = document.getElementById('district-id');
            const townshipSelect = document.getElementById('township-id');
            const photoInput = document.getElementById('photo');
            const imagePreview = document.getElementById('image-preview');
            const previewWrapper = document.getElementById('image-preview-wrapper');

            // ၁။ တိုင်းဒေသကြီး ပြောင်းလဲချိန်၌ သက်ဆိုင်ရာ ခရိုင်များ ဆွဲတင်ပေးခြင်း
            divisionSelect.addEventListener('change', function() {
                const divisionId = this.value;

                // ခရိုင် နှင့် မြို့နယ် dropdown များကို format ချပြီး ပိတ်ထားမည်
                districtSelect.innerHTML = '<option value="">-- ခရိုင် ရွေးချယ်ရန် --</option>';
                districtSelect.disabled = true;
                townshipSelect.innerHTML = '<option value="">-- ခရိုင်အရင်ရွေးပါ --</option>';
                townshipSelect.disabled = true;

                if (!divisionId) return;

                let url = "{{ route('admin.get-districts-by-division', ':id') }}";
                url = url.replace(':id', divisionId);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Server error: ' + response.status);
                        return response.json();
                    })
                    .then(data => {
                        if (data.length === 0) {
                            districtSelect.innerHTML = '<option value="">-- ဒေတာမရှိပါ --</option>';
                        } else {
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.name;
                                districtSelect.appendChild(option);
                            });
                            districtSelect.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('AJAX Error:', error);
                        districtSelect.innerHTML =
                            '<option value="">-- Error Loading Districts --</option>';
                    });
            });

            // ၂။ ခရိုင် ပြောင်းလဲချိန်၌ သက်ဆိုင်ရာ မြို့နယ်များ ဆွဲတင်ပေးခြင်း
            districtSelect.addEventListener('change', function() {
                const districtId = this.value;

                townshipSelect.innerHTML = '<option value="">-- မြို့နယ် ရွေးချယ်ရန် --</option>';
                townshipSelect.disabled = true;

                if (!districtId) return;

                // Route dynamically created with Laravel Route Name
                let url = "{{ route('admin.get-townships-by-district', ':id') }}";
                url = url.replace(':id', districtId);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Server error: ' + response.status);
                        return response.json();
                    })
                    .then(data => {
                        if (data.length === 0) {
                            townshipSelect.innerHTML = '<option value="">-- ဒေတာမရှိပါ --</option>';
                        } else {
                            data.forEach(township => {
                                const option = document.createElement('option');
                                option.value = township.id;
                                option.textContent = township.name;
                                townshipSelect.appendChild(option);
                            });
                            townshipSelect.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('AJAX Error:', error);
                        townshipSelect.innerHTML =
                            '<option value="">-- Error Loading Townships --</option>';
                    });
            });

            // ၃။ Image Live Preview စနစ် ရေးဆွဲခြင်း
            photoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        previewWrapper.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewWrapper.classList.add('d-none');
                }
            });
        });
    </script>
@endsection
