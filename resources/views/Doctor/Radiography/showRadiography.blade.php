<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient Radiographies</title>
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
  
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold">Radiographies for {{ $patient->name }}</h5>
                    <a href="{{ route('doctor.radiography.create', $patient) }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Add New Radiography
                    </a>
                </div>

                <div class="row">
                    @forelse($radiographies as $radiography)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{asset('Image/'.$radiography->image)}}" class="card-img-top" alt="Radiography Image">
                                <div class="card-body">
                                    <h6 class="card-title">Date: {{ $radiography->image_date->format('Y-m-d') }}</h6>
                                    <p class="card-text">{{ $radiography->description }}</p>
                                    <form action="{{ route('doctor.radiography.destroy', $radiography) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this radiography?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No radiographies found for this patient.
                            </div>
                        </div>
                    @endforelse
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