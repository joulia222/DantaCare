<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inspections</title>
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
            <img src="{{asset('Dashboard_assets/assets/images/logos/dark-logo.svg')}}" width="180" alt="" />
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
  
              @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- message Section --}}
                @if (session('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                {{-- end message Section --}}
  
                <h5 class="card-title fw-semibold mb-4">Inspections for Medical Record #{{ $medicalRecord->id }}</h5>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('doctor.medical.record.inspections.create', $medicalRecord) }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Add New Inspection
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date & Time</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Result</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Medicine</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Next Inspection</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Doctor</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Actions</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inspections as $inspection)
                                <tr>
                                    <td>{{ $inspection->name }}</td>
                                    <td>{{ $inspection->date_time->format('Y-m-d H:i') }}</td>
                                    <td>{{ $inspection->result }}</td>
                                    <td>{{ $inspection->medicine }}</td>
                                    <td>{{ $inspection->next_inspection_date->format('Y-m-d') }}</td>
                                    <td>{{ $inspection->doctor->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('doctor.medical.record.inspections.edit', [$medicalRecord, $inspection]) }}" 
                                               class="btn btn-info btn-sm me-2">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('doctor.medical.record.inspections.destroy', [$medicalRecord, $inspection]) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this inspection?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No inspections found.</td>
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