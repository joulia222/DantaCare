<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Service</title>
  @include('Layouts.Reception.LinkHeader')
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="{{asset('Dashboard_assets/assets/images/logos/dark-logo.svg')}}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        @include('Layouts.Reception.Sidebar')
      </div>
    </aside>

    <div class="body-wrapper">
      @include('Layouts.Reception.Header')

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Edit Service</h5>

                @if (session('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('reception.service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $service->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $service->price }}" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="more_info" class="form-label">More Information</label>
                        <textarea class="form-control" id="more_info" name="more_info" rows="3" required>{{ $service->more_info }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" {{ $service->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $service->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Service Image</label>
                        @if($service->image)
                            <div class="mb-2">
                                <img src="{{ asset('image/' . $service->image) }}" alt="Current Image" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Max file size: 2MB. Allowed formats: jpeg, png, jpg, gif, svg</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Service</button>
                    <a href="{{ route('reception.service.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
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
