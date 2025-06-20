<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
  <ul id="sidebarnav">
      <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
      </li>
      <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('doctor.index') }}" aria-expanded="false">
              <span>
                  <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
          </a>
      </li>

      <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Services</span>
      </li>

      <style>
          .sidebar-link {
              display: flex;
              align-items: center;
              justify-content: space-between;
              cursor: pointer;
          }

          .arrow-icon {
              transition: transform 0.3s ease;
          }

          .sidebar-details[open] .arrow-icon {
              transform: rotate(180deg);
          }
      </style>


      <li class="sidebar-item">
          <details class="sidebar-details">
              <summary class="sidebar-link">
                  <span>
                    <i class="ti ti-calendar-event"></i>
                  </span>
                  <span class="hide-menu">Appointment</span>
                  <i class="ti ti-chevron-down arrow-icon"></i>
              </summary>
              <ul style="padding-left: 1rem; list-style: none;">
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.appointments.create') }}">
                          <span class="hide-menu">Create New</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.appointments.index') }}">
                          <span class="hide-menu">All</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.appointments.index', 'pending') }}">
                          <span class="hide-menu">Pending</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.appointments.index', 'cancelled') }}">
                          <span class="hide-menu">Cancelled</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.appointments.index', 'completed') }}">
                          <span class="hide-menu">Completed</span>
                      </a>
                  </li>
              </ul>
          </details>
      </li>


      <li class="sidebar-item">
          <details class="sidebar-details">
              <summary class="sidebar-link">
                  <span>
                    <i class="ti ti-clipboard"></i>
                  </span>
                  <span class="hide-menu">Supplies Request</span>
                  <i class="ti ti-chevron-down arrow-icon"></i>
              </summary>
              <ul style="padding-left: 1rem; list-style: none;">
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.supplies.request.create') }}">
                          <span class="hide-menu">Create New Request</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.supplies.request.index') }}">
                          <span class="hide-menu">All Requests</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.supplies.request.index', 'pending') }}">
                          <span class="hide-menu">Pending</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.supplies.request.index', 'cancelled') }}">
                          <span class="hide-menu">Cancelled</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.supplies.request.index', 'completed') }}">
                          <span class="hide-menu">Completed</span>
                      </a>
                  </li>
              </ul>
          </details>
      </li>

      <li class="sidebar-item">
          <details class="sidebar-details">
              <summary class="sidebar-link">
                  <span>
                    <i class="ti ti-messages"></i>

                  </span>
                  <span class="hide-menu">Consultation</span>
                  <i class="ti ti-chevron-down arrow-icon"></i>
              </summary>
              <ul style="padding-left: 1rem; list-style: none;">
                 
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.consultation.index') }}">
                          <span class="hide-menu">Consultation Table</span>
                      </a>
                  </li>
              </ul>
          </details>
    </li> 

    <li class="sidebar-item">
          <details class="sidebar-details">
              <summary class="sidebar-link">
                  <span>
                    <i class="ti ti-clock"></i>

                  </span>
                  <span class="hide-menu">Nurse Hour</span>
                  <i class="ti ti-chevron-down arrow-icon"></i>
              </summary>
              <ul style="padding-left: 1rem; list-style: none;">
                 
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.nurse.hour.index') }}">
                          <span class="hide-menu">Nurse Work Hour Table</span>
                      </a>
                  </li>

                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.nurse.hour.create') }}">
                          <span class="hide-menu">Create Nurse Work Hour</span>
                      </a>
                  </li>
              </ul>
          </details>
    </li> 

    <li class="sidebar-item">
          <details class="sidebar-details">
              <summary class="sidebar-link">
                  <span>
                    <i class="ti ti-file"></i>
                  </span>
                  <span class="hide-menu">Medical Record</span>
                  <i class="ti ti-chevron-down arrow-icon"></i>
              </summary>
              <ul style="padding-left: 1rem; list-style: none;">
              <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.medical.record.index') }}">
                          <span class="hide-menu">All Medical Records</span>
                      </a>
                  </li>       
              </ul>
          </details>
    </li>

    <li class="sidebar-item">
          <details class="sidebar-details">
              <summary class="sidebar-link">
                  <span>
                    <i class="ti ti-radioactive"></i>
                  </span>
                  <span class="hide-menu">Radiography</span>
                  <i class="ti ti-chevron-down arrow-icon"></i>
              </summary>
              <ul style="padding-left: 1rem; list-style: none;">
                 <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('doctor.radiography.index') }}">
                          <span class="hide-menu">All Radiography</span>
                      </a>
                  </li>     
                
              </ul>
          </details>
    </li>

  </ul>

  {{--     
<!-- تضمين Bootstrap JS (مطلوب لتفعيل الـ collapse) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
</nav>
