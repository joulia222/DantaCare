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
      
              <h5 class="card-title fw-semibold mb-4">Create Receptionist</h5>
                {{-- <div class="card-body"> --}}
                    <form method="post" action="{{route('admin.receptionist.store')}}" enctype="multipart/form-data">
                        @csrf  
                        @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                          </ul>
                        </div>  
                        @endif                                           
                        <div class="d-flex gap-3">
                            <div class="mb-3 w-50">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3 w-50">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                        </div>                        
                        <div class="d-flex gap-3">
                            <div class="mb-3 w-50">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3 w-50">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone">
                            </div>
                        </div>                        
                        <div class="d-flex gap-3">
                            <div class="mb-3 w-50">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3 w-50">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age">
                            </div>
                        </div>                        
                        <div class="d-flex gap-3">
                            <div class="mb-3 w-50">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="1">Female</option>
                                    <option value="0">Male</option>
                                </select>
                            </div>
                            <div class="mb-3 w-50">
                                <label for="" class="form-label">Upload image</label>
                                <input type="file" class="form-control" id="basic-icon-default-image" name="img" required>
                            </div>
                        </div> 
                        <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('admin.receptionist.index') }}" class="btn btn-secondary">Cancel</a>
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