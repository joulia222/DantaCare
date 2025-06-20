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
   
        <div class="card" style="box-shadow: 5px 5px 20px gray;">
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
              <h5 class="card-title fw-semibold mb-4">Create Department</h5>
            
                {{-- <div class="card-body"> --}}
                    <form method="post" action="{{route('admin.department.store')}}" enctype="multipart/form-data">
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
                            <!-- تأكد من تضمين Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<div class="mb-3 w-50">
    <label for="code" class="form-label">Code</label>
    <div class="input-group">
        <input type="text" class="form-control" id="code" name="code" value="{{ strtoupper(Str::random(4)) }}" readonly>
        <button type="button" class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center"
            style="width: 40px; height: 40px;" onclick="regenerateCode()">
            <i class="bi bi-arrow-repeat"></i> <!-- أيقونة السهم -->
        </button>
    </div>
</div>

<script>
    function regenerateCode() {
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let code = '';
        for (let i = 0; i < 4; i++) {
            code += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        document.getElementById('code').value = code;
    }
</script>

                        </div>    
                        <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('admin.department.index') }}" class="btn btn-secondary">Cancel</a>
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