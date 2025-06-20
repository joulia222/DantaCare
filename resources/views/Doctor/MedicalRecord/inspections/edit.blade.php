<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Inspection</title>
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
  
                <h5 class="card-title fw-semibold mb-4">Edit Inspection for Medical Record #{{ $medicalRecord->id }}</h5>
                
                <form action="{{ route('doctor.medical.record.inspections.update', [$medicalRecord, $inspection]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Inspection Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $inspection->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date_time" class="form-label">Date & Time</label>
                            <input type="datetime-local" class="form-control @error('date_time') is-invalid @enderror" 
                                   id="date_time" name="date_time" 
                                   value="{{ old('date_time', $inspection->date_time->format('Y-m-d\TH:i')) }}" required>
                            @error('date_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="result" class="form-label">Result</label>
                            <textarea class="form-control @error('result') is-invalid @enderror" 
                                      id="result" name="result" rows="3" required>{{ old('result', $inspection->result) }}</textarea>
                            @error('result')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="medicine" class="form-label">Medicine</label>
                            <textarea class="form-control @error('medicine') is-invalid @enderror" 
                                      id="medicine" name="medicine" rows="3" required>{{ old('medicine', $inspection->medicine) }}</textarea>
                            @error('medicine')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="next_inspection_date" class="form-label">Next Inspection Date</label>
                            <input type="date" class="form-control @error('next_inspection_date') is-invalid @enderror" 
                                   id="next_inspection_date" name="next_inspection_date" 
                                   value="{{ old('next_inspection_date', $inspection->next_inspection_date->format('Y-m-d')) }}" required>
                            @error('next_inspection_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-edit me-2"></i>Update Inspection
                            </button>
                            <a href="{{ route('doctor.medical.record.inspections.index', $medicalRecord) }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Back
                            </a>
                        </div>
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
</body>

</html> 