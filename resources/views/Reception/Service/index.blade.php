<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Service</title>
@include('Layouts.Reception.LinkHeader')
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
        @include('Layouts.Reception.Sidebar')
        <!-- End Sidebar navigation -->
        
       
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">

      <!--  Header Start -->
      @include('Layouts.Reception.Header')
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
  
                <h5 class="card-title fw-semibold mb-4">Service Table</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">ID</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>

                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Description</h6>
                          </th>

                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Price</h6>
                        </th>

                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">More Info</h6>
                          </th>

                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                          </th>

                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Image</h6>
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
                          <h6 class="fw-semibold mb-0">Action</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($services as $service)
                                      <tr>
                                          <th scope="row">{{$service->id}}</th>
                                          <td>{{$service->name}}</td>
                                          <td>{{$service->description}}</td>
                                          <td>{{$service->price}}</td>
                                          <td>{{$service->more_info}}</td>
                                          <td>{{$service->status}}</td>
                                          <td>
                                          <img src="{{ asset('image/' . $service->image) }}"
                                          style="width: 50px; height: 50px; object-fit: cover;">
                                           </td>
                                          <td>{{$service->storeKeeperEmployee->name ?? '-'}}</td>
                                          <td>{{$service->created_at}}</td>
                                          <td>{{$service->updated_at}}</td>
                                          <td>
                                              <div class="dropdown">
                                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                  </button>
                                                  <div class="dropdown-menu">
                                                      <form method="post" action="{{route('reception.service.delete' ,$service->id)}}">
                                                          @csrf
                                                          @method('delete')
                                                          <button class="dropdown-item btn" type="submit">
                                                              <i class="bx bx-trash me-1"></i> Delete
                                                          </button>
                                                      </form>                                                        
                                                        <a href="{{route('reception.service.edit',$service->id)}}" class="dropdown-item btn" type="submit">
                                                            <i class="bx bx-trash me-1"></i> Edit
                                                        </a>
                                                    
                                                  </div>
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
 @include('Layouts.Reception.LinkJS')
</body>

</html>