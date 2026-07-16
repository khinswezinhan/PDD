@extends('components.admin-layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-5" style="max-width: 800px;">

        <div class="mb-4 d-flex align-items-center gap-2">
            <a href="{{ route('admin.pagodas.index') }}" class="btn btn-outline-secondary btn-sm rounded-circle px-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h4 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">ဘုရားစေတီပုထိုးအချက်အလက် ပြင်ဆင်ရန်</h4>
        </div>

        <div class="card border border-light-subtle shadow-sm rounded-3 bg-white p-4">
            <form action="{{ route('admin.pagodas.update', $pagoda->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- စေတီပုထိုးတော်ဘွဲ့အမည် -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        စေတီပုထိုးတော်ဘွဲ့အမည် (Pagoda Name) <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $pagoda->name) }}" required
                        placeholder="ဥပမာ - ရွှေတိဂုံစေတီတော်မြတ်ကြီး"
                        class="form-control py-2.5 rounded-2 @error('name') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    @error('name')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- တိုင်း/ခရိုင်/မြို့နယ် Dynamic Dropdown -->
                <div class="row">
                    <!-- တိုင်းဒေသကြီး -->
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
                                    {{ old('division_id', $pagoda->township->district->division_id ?? '') == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select> <!-- စာလုံးပေါင်းမှားနေသည်ကို ပြင်ဆင်ပြီး -->
                        @error('division_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ခရိုင် -->
                    <div class="col-md-4 mb-4">
                        <label for="district-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                            ခရိုင် ရွေးချယ်ရန် <span class="text-danger">*</span>
                        </label>
                        <select id="district-id" name="district_id" required
                            class="form-select py-2.5 rounded-2 @error('district_id') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                            <option value="">-- ရွေးချယ်ရန် --</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ old('district_id', $pagoda->township->district_id ?? '') == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- မြို့နယ် -->
                    <div class="col-md-4 mb-4">
                        <label for="township-id" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                            မြို့နယ် ရွေးချယ်ရန် <span class="text-danger">*</span>
                        </label>
                        <select id="township-id" name="township_id" required
                            class="form-select py-2.5 rounded-2 @error('township_id') is-invalid @enderror"
                            style="font-size: 0.95rem;">
                            <option value="">-- ရွေးချယ်ရန် --</option>
                            @foreach ($townships as $township)
                                <option value="{{ $township->id }}"
                                    {{ old('township_id', $pagoda->township_id) == $township->id ? 'selected' : '' }}>
                                    {{ $township->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('township_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ဓာတ်ပုံ တင်ရန် နှင့် လက်ရှိပုံပြသရန် -->
                <div class="mb-4">
                    <label for="photo" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        စေတီတော်ဓာတ်ပုံ ပြောင်းလဲရန် (Photo)
                    </label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="form-control py-2 rounded-2 @error('photo') is-invalid @enderror"
                        style="font-size: 0.95rem;">

                    <!-- Image Preview Wrapper -->
                    <div id="image-preview-wrapper" class="mt-3">
                        <span class="d-block small text-muted mb-2">လက်ရှိ/နမူနာ ဓာတ်ပုံ -</span>
                        <img id="image-preview"
                            src="{{ $pagoda->photo ? asset($pagoda->photo) : asset('images/default-pagoda.png') }}"
                            alt="Pagoda Preview" class="img-thumbnail shadow-sm"
                            style="max-height: 180px; width: auto; object-fit: cover;">
                    </div>

                    @error('photo')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- ဝဘ်ဆိုက်လင့်ခ် -->
                <div class="mb-4">
                    <label for="website" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        ဝဘ်ဆိုက်လင့်ခ် (Website Link)
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-secondary border-end-0">
                            <i class="fas fa-globe"></i>
                        </span>
                        <input type="url" name="website" id="website" value="{{ old('website', $pagoda->website) }}"
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

                <!-- မြေပုံတည်နေရာလင့်ခ် -->
                <div class="mb-4">
                    <label for="map_link" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        မြေပုံတည်နေရာလင့်ခ် (Google Map Link) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-secondary border-end-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <input type="url" name="map_link" id="map_link"
                            value="{{ old('map_link', $pagoda->map_link) }}" required
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

                <!-- တည်နေရာလိပ်စာအပြည့်အစုံ -->
                <div class="mb-4">
                    <label for="address" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        တည်နေရာလိပ်စာအပြည့်အစုံ (Address) <span class="text-danger">*</span>
                    </label>
                    <textarea name="address" id="address" rows="3" required
                        placeholder="ဥပမာ - ရွှေတိဂုံကုန်းတော်၊ ဗဟန်းမြို့နယ်၊ ရန်ကုန်မြို့။"
                        class="form-control rounded-2 @error('address') is-invalid @enderror" style="font-size: 0.95rem; resize: none;">{{ old('address', $pagoda->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- စေတီတော်သမိုင်းအကျဉ်း -->
                <div class="mb-4">
                    <label for="history" class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        စေတီတော်သမိုင်းအကျဉ်း (History) <span class="text-danger">*</span>
                    </label>
                    <textarea name="history" id="history" rows="5" required
                        placeholder="စေတီတော်မြတ်ကြီး တည်ထားကိုးကွယ်ခဲ့သော သမိုင်းကြောင်းအား..."
                        class="form-control rounded-2 @error('history') is-invalid @enderror" style="font-size: 0.95rem;">{{ old('history', $pagoda->history) }}</textarea>
                    @error('history')
                        <div class="invalid-feedback d-flex align-items-center gap-1 mt-2">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Status ပြင်ဆင်ရန်နေရာ -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.9rem;">
                        အဆင့်အတန်းသတ်မှတ်ချက် (Status) <span class="text-danger">*</span>
                    </label>
                    <div class="d-flex gap-4 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="famous" id="famous"
                                {{ old('status', $pagoda->status) == 'famous' ? 'checked' : '' }} required>
                            <label class="form-check-label fw-medium text-dark" for="famous">
                                Famous (ထင်ရှားကျော်ကြား)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="normal" id="normal"
                                {{ old('status', $pagoda->status) == 'normal' ? 'checked' : '' }} required>
                            <label class="form-check-label fw-medium text-dark" for="normal">
                                Normal (သာမန်)
                            </label>
                        </div>
                    </div>
                    @error('status')
                        <div class="text-danger small mt-2 d-flex align-items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- ခလုတ်များ -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-light-subtle mt-4">
                    <a href="{{ route('admin.pagodas.index') }}"
                        class="btn btn-outline-secondary px-4 py-2 rounded-2 fw-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="btn btn-primary px-4 py-2 rounded-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="fas fa-save"></i> ပြင်ဆင်မှုများသိမ်းမည်
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division-id');
            const districtSelect = document.getElementById('district-id');
            const townshipSelect = document.getElementById('township-id');
            const photoInput = document.getElementById('photo');
            const imagePreview = document.getElementById('image-preview');

            // ၁။ တိုင်းဒေသကြီး ပြောင်းလဲချိန်
            divisionSelect.addEventListener('change', function() {
                const divisionId = this.value;

                // တိုင်းပြောင်းတာနဲ့ ခရိုင်ရော၊ မြို့နယ်ပါ အသစ်ပြန်ရွေးခိုင်းဖို့ Reset ချသည်
                districtSelect.innerHTML = '<option value="">-- ရွေးချယ်ရန် --</option>';
                townshipSelect.innerHTML = '<option value="">-- ရွေးချယ်ရန် --</option>';
                townshipSelect.disabled = true;

                if (!divisionId) {
                    districtSelect.disabled = true;
                    return;
                }

                let url = "{{ route('admin.get-districts-by-division', ':id') }}";
                url = url.replace(':id', divisionId);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        districtSelect.disabled = false;
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            });

            // ၂။ ခရိုင် ပြောင်းလဲချိန်
            districtSelect.addEventListener('change', function() {
                const districtId = this.value;

                // ခရိုင်ပြောင်းတာနဲ့ မြို့နယ်ကို အရင်ရှင်းမည်
                townshipSelect.innerHTML = '<option value="">-- ရွေးချယ်ရန် --</option>';

                if (!districtId) {
                    townshipSelect.disabled = true;
                    return;
                }

                let url = "{{ route('admin.get-townships-by-district', ':id') }}";
                url = url.replace(':id', districtId);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        townshipSelect.disabled = false;
                        data.forEach(township => {
                            const option = document.createElement('option');
                            option.value = township.id;
                            option.textContent = township.name;
                            townshipSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching townships:', error));
            });

            // ၃။ ပုံအသစ်တင်ရင် Live Preview ပြောင်းပေးခြင်း
            photoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
