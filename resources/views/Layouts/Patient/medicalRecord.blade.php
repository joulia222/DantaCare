<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medical Record</title>
@include('Layouts.Patient.LinkHeader')
<style>
    /* Main Layout */
    body {
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    /* Header Styling */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        width: 100%;
        background: #1E90FF !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .navbar-brand {
        color: #ffffff !important;
        font-weight: 600;
        font-size: 1.5rem;
    }
    
    .navbar-brand span {
        color: #B0E0E6;
    }
    
    .nav-link {
        color: #ffffff !important;
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        transition: all 0.3s ease;
    }
    
    .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(255,255,255,0.2);
        border-radius: 4px;
    }
    
    .nav-item.active .nav-link {
        color: #ffffff !important;
        background-color: rgba(255,255,255,0.3);
        border-radius: 4px;
    }
    
    /* Content Area */
    .container-fluid {
        padding-top: 80px;
        flex: 1;
    }
    
    /* Card Styling */
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
        margin-bottom: 20px;
        background-color: #ffffff;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .card-title {
        color: #2c3038;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    /* Table Styling */
    .table-responsive {
        margin-bottom: 2rem;
    }
    
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }
    
    .table th {
        background-color: #f8f9fa;
        color: #2c3038;
        font-weight: 600;
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }
    
    /* Alert Styling */
    .alert {
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        padding: 1rem;
    }
    
    .alert-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }
    
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding-top: 60px;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .table td, .table th {
            padding: 0.75rem;
        }
    }
</style>
</head>

<body>
    @include('Layouts.Patient.Header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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

                        @if($medicalRecord)
                            <div class="mb-4">
                                <h5 class="card-title">Medical Record Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Record ID:</strong> {{ $medicalRecord->id }}</p>
                                        <p><strong>Patient Name:</strong> {{ $medicalRecord->patient->name }}</p>
                                        <p><strong>Created By:</strong> {{ $medicalRecord->reception->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Created At:</strong> {{ $medicalRecord->created_at->format('Y-m-d H:i') }}</p>
                                        <p><strong>Last Updated:</strong> {{ $medicalRecord->updated_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <h5 class="card-title">Inspections</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Inspection Name</th>
                                            <th>Date & Time</th>
                                            <th>Doctor</th>
                                            <th>Result</th>
                                            <th>Medicine</th>
                                            <th>Next Inspection</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($inspections as $inspection)
                                            <tr>
                                                <td>{{ $inspection->name }}</td>
                                                <td>{{ $inspection->date_time->format('Y-m-d H:i') }}</td>
                                                <td>{{ $inspection->doctor->name }}</td>
                                                <td>{{ $inspection->result }}</td>
                                                <td>{{ $inspection->medicine }}</td>
                                                <td>{{ $inspection->next_inspection_date ? $inspection->next_inspection_date->format('Y-m-d') : 'Not scheduled' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No inspections found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <h5 class="alert-heading">No Medical Record Found</h5>
                                <p>You don't have a medical record yet. Please contact the reception to create one.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Layouts.Patient.LinkJS')
    @include('Layouts.Patient.Footer')
</body>

</html>