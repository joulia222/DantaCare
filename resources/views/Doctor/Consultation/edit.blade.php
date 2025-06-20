<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Consultation</title>
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

                <h5 class="card-title fw-semibold mb-4">Edit Consultation</h5>
                
                <form action="{{ route('doctor.consultation.update', $consultation) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Patient Name</label>
                            <input type="text" class="form-control" value="{{ $consultation->patient->name ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Patient Email</label>
                            <input type="text" class="form-control" value="{{ $consultation->patient->email ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Patient Phone</label>
                            <input type="text" class="form-control" value="{{ $consultation->patient->phone ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Created Date</label>
                            <input type="text" class="form-control" value="{{ $consultation->created_at }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <textarea class="form-control" rows="3" readonly>{{ $consultation->question }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" rows="5">{{ old('answer', $consultation->answer) }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('doctor.consultation.index') }}" class="btn btn-light me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Answer</button>
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
