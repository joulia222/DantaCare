<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('Dashboard_assets/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('Dashboard_assets/assets/css/styles.min.css')}}" />
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
        @include('Layouts.Admin.Sidebar')
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('Layouts.Admin.Header')
      <!--  Header End -->
      <div class="container-fluid">
          <div class="card">
            <div class="card-body">

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
      
              <h5 class="card-title fw-semibold mb-4">Edit Specialization Information</h5>
             
                <div class="card-body">
                    <form method="post" action="{{ route('admin.specialization.update', $specialization->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                          </ul>
                        </div>  
                        @endif  
                        {{-- <div class="mb-3">
                          <label for="dentistSpecialization" class="form-label">Name of Specialization</label>
                          <select  name="name" class="form-control" id="dentistSpecialization">
                            <option value="General Dentistry" {{ $specialization->name == 'General Dentistry' ? 'selected' : '' }}>General Dentistry</option>
                            <option value="Orthodontics" {{ $specialization->name == 'Orthodontics' ? 'selected' : '' }}>Orthodontics</option>
                            <option value="Periodontics" {{ $specialization->name == 'Periodontics' ? 'selected' : '' }}>Periodontics</option>
                            <option value="Prosthodontics" {{ $specialization->name == 'Prosthodontics' ? 'selected' : '' }}>Prosthodontics</option>
                            <option value="Endodontics" {{ $specialization->name == 'Endodontics' ? 'selected' : '' }}>Endodontics</option>
                            <option value="Oral and Maxillofacial Surgery" {{ $specialization->name == 'Oral and Maxillofacial Surgery' ? 'selected' : '' }}>Oral and Maxillofacial Surgery</option>
                            <option value="Pediatric Dentistry" {{ $specialization->name == 'Pediatric Dentistry' ? 'selected' : '' }}>Pediatric Dentistry</option>
                            <option value="Cosmetic Dentistry" {{ $specialization->name == 'Cosmetic Dentistry' ? 'selected' : '' }}>Cosmetic Dentistry</option>
                          </select>
                        </div>      --}}
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Description</label>
                          <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="name" value="{{$specialization->name}}">
                      </div>                                          
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="description" value="{{$specialization->description}}">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.specialization.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
                </div>
           
            </div>
          </div>
      </div>
    </div>
  </div>
  @include('Layouts.Admin.LinkJS')
</body>

</html>