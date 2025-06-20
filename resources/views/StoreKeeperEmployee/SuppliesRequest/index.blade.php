<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplies Request - {{ ucfirst($status) }}</title>
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
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">

                                <!-- Message Section -->
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
                                <!-- End Message Section -->

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="card-title fw-semibold">Supplies Request Table - {{ ucfirst($status) }}
                                    </h5>

                                    <!-- Status Filter Pills -->
                                    <div class="status-filters">
                                        <a href="{{ route('storeKeeperEmployee.supplies.request.index') }}"
                                            class="btn btn-sm {{ $status == 'all' ? 'btn-primary' : 'btn-outline-primary' }} me-1">All</a>
                                        <a href="{{ route('storeKeeperEmployee.supplies.request.index', 'pending') }}"
                                            class="btn btn-sm {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }} me-1">Pending</a>
                                        <a href="{{ route('storeKeeperEmployee.supplies.request.index', 'completed') }}"
                                            class="btn btn-sm {{ $status == 'completed' ? 'btn-success' : 'btn-outline-success' }} me-1">Completed</a>
                                        <a href="{{ route('storeKeeperEmployee.supplies.request.index', 'cancelled') }}"
                                            class="btn btn-sm {{ $status == 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }}">Cancelled</a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">ID</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Medical Supplies Name</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Type</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Doctor Name</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Quantity</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Change Status By</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Taken Date</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">ReEntry Date</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Is Return In Date</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Reject Cause</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Created Date</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($suppliesRequests as $suppliesRequest)
                                                <tr
                                                    class="{{ $suppliesRequest->status === 'pending' ? 'table-warning' : ($suppliesRequest->status === 'completed' ? 'table-success' : 'table-danger') }}">
                                                    <th scope="row">{{ $suppliesRequest->id }}</th>
                                                    <td>{{ $suppliesRequest->medicalSupplies->name ?? '-' }}</td>
                                                    <td>{{ $suppliesRequest->type }}</td>
                                                    <td>{{ $suppliesRequest->doctor->name ?? '-' }}</td>
                                                    <td>{{ $suppliesRequest->quantity }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $suppliesRequest->status === 'pending' ? 'warning' : ($suppliesRequest->status === 'completed' ? 'success' : 'danger') }}">
                                                            {{ $suppliesRequest->status }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $suppliesRequest->storeKeeperEmployee->name ?? '-' }}</td>
                                                    <td>{{ $suppliesRequest->taken_date }}</td>
                                                    <td>{{ $suppliesRequest->re_entry_date }}</td>
                                                    <td>{{ $suppliesRequest->is_return_in_date ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $suppliesRequest->reject_cause }}</td>
                                                    <td>{{ $suppliesRequest->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>
                                                        @if ($suppliesRequest->status === 'pending')
                                                            <div class="btn-group">
                                                                <form method="post"
                                                                    action="{{ route('storeKeeperEmployee.supplies.request.approve', $suppliesRequest->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button class="btn btn-sm btn-success me-1"
                                                                        type="submit">
                                                                        <i class="ti ti-check"></i> Approve
                                                                    </button>
                                                                </form>

                                                                @endif

                                                                @if($suppliesRequest->status === 'completed' && is_null($suppliesRequest->re_entry_date) && $suppliesRequest->type === 'device' )

                                                      
                                                                <button type="button"
                                                                    class="btn btn-sm btn-success me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#reEntryModal{{ $suppliesRequest->id }}">
                                                                    <i class="ti ti-check"></i> Re-Entry
                                                                </button>

                                                                <!-- Modal for Re-Entry -->
                                                                <div class="modal fade"
                                                                    id="reEntryModal{{ $suppliesRequest->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="reEntryModalLabel{{ $suppliesRequest->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="reEntryModalLabel{{ $suppliesRequest->id }}">
                                                                                    Re-Entry Supply Request
                                                                                    #{{ $suppliesRequest->id }}</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <form method="post"
                                                                                action="{{ route('storeKeeperEmployee.supplies.request.return', $suppliesRequest->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3">
                                                                                        <label for="re_entry_date"
                                                                                            class="form-label">Re-Entry
                                                                                            Date</label>
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            id="re_entry_date"
                                                                                            name="re_entry_date"
                                                                                            required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="is_return_in_date"
                                                                                            class="form-label">Returned
                                                                                            On Time?</label>
                                                                                        <select class="form-select"
                                                                                            id="is_return_in_date"
                                                                                            name="is_return_in_date"
                                                                                            required>
                                                                                            <option value="">
                                                                                                Select option</option>
                                                                                            <option value="1">Yes
                                                                                            </option>
                                                                                            <option value="0">No
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-success">Confirm
                                                                                        Re-Entry</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @endif
                                                        
                                                                @if ($suppliesRequest->status === 'pending')
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#cancelModal{{ $suppliesRequest->id }}">
                                                                    <i class="ti ti-x"></i> Cancel
                                                                </button>

                                                                <!-- Modal for Cancel Reason -->
                                                                <div class="modal fade"
                                                                    id="cancelModal{{ $suppliesRequest->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="cancelModalLabel{{ $suppliesRequest->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="cancelModalLabel{{ $suppliesRequest->id }}">
                                                                                    Cancel Supply Request
                                                                                    #{{ $suppliesRequest->id }}</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <form method="post"
                                                                                action="{{ route('storeKeeperEmployee.supplies.request.reject', $suppliesRequest->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3">
                                                                                        <label for="reject_cause"
                                                                                            class="form-label">Cancellation
                                                                                            Reason</label>
                                                                                        <textarea class="form-control" id="reject_cause" name="reject_cause" rows="3" required></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">Confirm
                                                                                        Cancellation</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            </div>
                                                        {{-- @else
                                                            <span class="text-muted">No actions available</span>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center">No supplies requests found
                                                    </td>
                                                </tr>
                                            @endforelse
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
    @include('Layouts.StoreKeeperEmployee.LinkJS')
</body>

</html>
