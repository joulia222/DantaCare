<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Medical Supplies</title>
    @include('Layouts.StoreKeeperEmployee.LinkHeader')
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
                        <img src="{{ asset('Dashboard_assets/assets/images/logos/dark-logo.svg') }}" width="180"
                            alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                @include('Layouts.StoreKeeperEmployee.Sidebar')
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('Layouts.StoreKeeperEmployee.Header')
            <!--  Header End -->
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Create Medical Supplies</h5>
                        {{-- <div class="card-body"> --}}
                        <form method="post" action="{{ route('storeKeeperEmployee.medicalSupplies.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- message Section --}}
                            @if (session('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- end message Section --}}

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
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
                                    <label for="code" class="form-label">Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="code" name="code"
                                            value="{{ strtoupper(Str::random(4)) }}" readonly>
                                        <button type="button"
                                            class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center"
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

                                <div class="mb-3 w-50">
                                    <label for="" class="form-label">Upload image</label>
                                    <input type="file" class="form-control" id="basic-icon-default-image"
                                        name="image" required>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <div class="mb-3 w-50">
                                    <label for="status" class="form-label">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="device">Device</option>
                                        <option value="material">Material</option>
                                        <option value="equipment">Equipment</option>
                                        <option value="medicine">Medicine</option>
                                    </select>
                                </div>

                                <div class="mb-3 w-50">
                                    <label for="age" class="form-label">Descreption</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>

                                <div class="mb-3 w-50">
                                    <label for="age" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('Layouts.StoreKeeperEmployee.LinkJS')
</body>

</html>
