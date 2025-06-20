<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Supplies Request</title>
    @include('Layouts.Doctor.LinkHeader')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('Dashboard_assets/assets/images/logos/dark-logo.svg') }}" width="180"
                            alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                @include('Layouts.Doctor.Sidebar')
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('Layouts.Doctor.Header')
            <!--  Header End -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                {{-- message Section --}}
                                @if (session('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                {{-- end message Section --}}

                                <h5 class="card-title fw-semibold mb-4">Create Supplies Request</h5>

                                <form action="{{ route('doctor.supplies.request.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Medical Supplies</label>
                                            <select class="form-select @error('medical_supplies_id') is-invalid @enderror" name="medical_supplies_id" id="medical_supplies_id">
                                                <option value="">Select Medical Supply</option>
                                                @foreach($medicalSupplies as $supply)
                                                    <option value="{{ $supply->id }}" 
                                                        data-type="{{ $supply->type }}"
                                                        {{ old('medical_supplies_id') == $supply->id ? 'selected' : '' }}>
                                                        {{ $supply->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('medical_supplies_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                                name="quantity" value="{{ old('quantity') }}" min="1">
                                            @error('quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Taken Date</label>
                                            <input type="datetime-local" class="form-control @error('taken_date') is-invalid @enderror" 
                                                name="taken_date" value="{{ old('taken_date') }}">
                                            @error('taken_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3" id="re_entry_date_container" style="display: none;">
                                            <label class="form-label">Re-entry Date</label>
                                            <input type="datetime-local" class="form-control @error('re_entry_date') is-invalid @enderror" 
                                                name="re_entry_date" value="{{ old('re_entry_date') }}">
                                            @error('re_entry_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('doctor.supplies.request.index') }}" class="btn btn-light me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Create Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Layouts.Doctor.LinkJS')
    <script>
        document.getElementById('medical_supplies_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const type = selectedOption.getAttribute('data-type');
            const reEntryDateContainer = document.getElementById('re_entry_date_container');
            
            if (type === 'device') {
                reEntryDateContainer.style.display = 'block';
            } else {
                reEntryDateContainer.style.display = 'none';
            }
        });

        // Trigger change event on page load if there's a selected value
        const medicalSuppliesSelect = document.getElementById('medical_supplies_id');
        if (medicalSuppliesSelect.value) {
            medicalSuppliesSelect.dispatchEvent(new Event('change'));
        }
    </script>
</body>

</html>
