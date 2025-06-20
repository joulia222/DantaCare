<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nurse Work Hour</title>
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
  
                <h5 class="card-title fw-semibold mb-4">Nurse Work Hour Table</h5>
             
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nurse ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nurse Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Start Time</h6>
                                </th>
                        
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">End Time</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Created By</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Created Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Last Updated Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Actions</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nurseWorkHours as $nurseWorkHour)
                                <tr>
                                    <th scope="row">{{$nurseWorkHour->id}}</th>
                                    <td>{{$nurseWorkHour->nurse->id ?? '-'}}</td>
                                    <td>{{$nurseWorkHour->nurse->name ?? '-'}}</td>
                                    <td>{{$nurseWorkHour->date ?? '-'}}</td>
                                    <td>{{$nurseWorkHour->start_time ?? '-'}}</td>  
                                    <td>{{$nurseWorkHour->end_time ?? '-'}}</td>      
                                    <td>{{$nurseWorkHour->doctor->name ?? '-'}}</td>
                                    <td>{{$nurseWorkHour->created_at}}</td>
                                    <td>{{$nurseWorkHour->updated_at}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('doctor.nurse.hour.edit', $nurseWorkHour) }}" class="btn btn-primary btn-sm me-2">
                                                <i class="ti ti-edit"></i>
                                            </a>    
                                            <form action="{{ route('doctor.nurse.hour.destroy', $nurseWorkHour) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach                    
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