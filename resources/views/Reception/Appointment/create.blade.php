<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Appointment</title>
    @include('Layouts.Reception.LinkHeader')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('Dashboard_assets/assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                @include('Layouts.Reception.Sidebar')
            </div>
        </aside>
        <!--  Sidebar End -->
        <div class="body-wrapper">
            @include('Layouts.Reception.Header')

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="card-title fw-semibold">Create New Appointment</h5>
                                    <a href="{{ route('reception.appointments.index') }}" class="btn btn-primary">
                                        <i class="ti ti-list me-2"></i>View All Appointments
                                    </a>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form action="{{ route('reception.appointments.store') }}" method="POST">
                                    @csrf


                                <!-- Message Section -->
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
                                <!-- End Message Section -->
                                 
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="clinic_id" class="form-label">Clinic <span class="text-danger">*</span></label>
                                            <select class="form-select @error('clinic_id') is-invalid @enderror" id="clinic_id" name="clinic_id" required>
                                                <option value="">Select Clinic</option>
                                                @foreach($clinics as $clinic)
                                                    <option value="{{ $clinic->id }}" {{ old('clinic_id') == $clinic->id ? 'selected' : '' }}>
                                                        {{ $clinic->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('clinic_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="doctor_id" class="form-label">Doctor <span class="text-danger">*</span></label>
                                            <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                                                <option value="">Select Doctor</option>
                                                @foreach($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                        {{ $doctor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('doctor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                                            <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                                                <option value="">Select Patient</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                                        {{ $patient->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="day" class="form-label">Day <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('day') is-invalid @enderror" 
                                                id="day" name="day" value="{{ old('day') }}" required>
                                            @error('day')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                                                id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control @error('end_time') is-invalid @enderror" 
                                                id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                                            @error('end_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-plus me-2"></i>Create Appointment
                                        </button>
                                        <a href="{{ route('reception.appointments.index') }}" class="btn btn-secondary">
                                            <i class="ti ti-x me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Layouts.Reception.LinkJS')
</body>

</html>