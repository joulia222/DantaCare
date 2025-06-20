<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment - {{ ucfirst($status) }}</title>
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

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="card-title fw-semibold">Appointment Table - {{ ucfirst($status) }}
                                    </h5>

                                    <!-- Status Filter Pills -->
                                    <div class="status-filters">
                                        <a href="{{ route('doctor.appointments.index') }}"
                                            class="btn btn-sm {{ $status == 'all' ? 'btn-primary' : 'btn-outline-primary' }} me-1">All</a>
                                        <a href="{{ route('doctor.appointments.index', 'pending') }}"
                                            class="btn btn-sm {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }} me-1">Pending</a>
                                        <a href="{{ route('doctor.appointments.index', 'completed') }}"
                                            class="btn btn-sm {{ $status == 'completed' ? 'btn-success' : 'btn-outline-success' }} me-1">Completed</a>
                                        <a href="{{ route('doctor.appointments.index', 'cancelled') }}"
                                            class="btn btn-sm {{ $status == 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }}">Cancelled</a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">ID</h6>
                                                </th>
                                            
                        
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Clinic Name</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Clinic Code</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Patient Name</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Patient Email</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Patient Phone</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Time And Date Start</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Time And Date End</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Day</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Doctor Name</h6>
                                                </th>


                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Doctor Email</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Doctor Phone</h6>
                                                </th>
                                        
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>
                                           
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Created Date</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($appointments as $appointment)
                                                <tr
                                                    class="{{ $appointment->status === 'pending' ? 'table-warning' : ($appointment->status === 'completed' ? 'table-success' : 'table-danger') }}">
                                                    <th scope="row">{{ $appointment->id }}</th>
                                                    <td>{{ $appointment->clinic->name ?? '-' }}</td>
                                                    <td>{{ $appointment->clinic->code ?? '-' }}</td>
                                                    <td>{{ $appointment->patient->name ?? '-' }}</td>
                                                    <td>{{ $appointment->patient->email ?? '-' }}</td>
                                                    <td>{{ $appointment->patient->phone ?? '-' }}</td>
                                                    <td>{{ $appointment->start_time }}</td>
                                                    <td>{{ $appointment->end_time }}</td>
                                                    <td>{{ $appointment->day }}</td>
                                                    <td>{{ $appointment->doctor->name ?? '-' }}</td>
                                                    <td>{{ $appointment->doctor->email ?? '-' }}</td>
                                                    <td>{{ $appointment->doctor->phone ?? '-' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $appointment->status === 'pending' ? 'warning' : ($appointment->status === 'completed' ? 'success' : 'danger') }}">
                                                            {{ $appointment->status }}
                                                        </span>
                                                    </td>
                                            
                                                    <td>{{ $appointment->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>
                                                        @if($appointment->status === 'pending')
                                                            <a href="{{ route('doctor.appointments.edit', $appointment->id) }}" class="btn btn-primary btn-sm">
                                                                <i class="ti ti-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="ti ti-check"></i> Complete
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('doctor.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="ti ti-x"></i> Cancel
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center">No appointment found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Layouts.Doctor.LinkJS')
</body>

</html>
