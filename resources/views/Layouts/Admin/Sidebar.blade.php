<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin.index')}}" aria-expanded="false">
          <span>
            <i class="ti ti-layout-dashboard"></i>
          </span>
          <span class="hide-menu">Dashboard</span>
        </a>
      </li>
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">UI COMPONENTS</span>
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

          details[open] .arrow-icon {
              transform: rotate(180deg);
          }
      </style>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-stethoscope"></i>
            </span>
            <span class="hide-menu">Doctors</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.doctor.index')}}">
                <span class="hide-menu">Doctor Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.doctor.create')}}">
                <span class="hide-menu">Create Doctor</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-medical-cross"></i>
            </span>
            <span class="hide-menu">Nurse</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.nurse.index')}}">
                <span class="hide-menu">Nurse Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.nurse.create')}}">
                <span class="hide-menu">Create Nurse</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-clipboard-check"></i> 
            </span>
            <span class="hide-menu">Receptionist</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.receptionist.index')}}">
                <span class="hide-menu">Receptionist Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.receptionist.create')}}">
                <span class="hide-menu">Create Receptionist</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-certificate"></i>
            </span>
            <span class="hide-menu">Specializations</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.specialization.index')}}">
                <span class="hide-menu">Specializations Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.specialization.create')}}">
                <span class="hide-menu">Create Specialization</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-building"></i>
            </span>
            <span class="hide-menu">Department</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.department.index')}}">
                <span class="hide-menu">Department Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.department.create')}}">
                <span class="hide-menu">Create Department</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <span>
                <!-- Replace with SVG icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hospital" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M3 21l18 0" />
                  <path d="M5 21v-14l7 -4l7 4v14" />
                  <path d="M9 21v-8h6v8" />
                  <path d="M10 12h4" />
                  <path d="M12 10v4" />
                </svg>
              </span>
                          </span>
            <span class="hide-menu">clinic</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.clinic.index')}}">
                <span class="hide-menu">Clinic Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.clinic.create')}}">
                <span class="hide-menu">Create Clinic</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-user"></i>
            </span>
            <span class="hide-menu">Store Keeper</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.storeKeeperEmployee.index')}}">
                <span class="hide-menu">Employee Table</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.storeKeeperEmployee.create')}}">
                <span class="hide-menu">Create Employee</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      
      <li class="sidebar-item">
        <details>
          <summary class="sidebar-link">
            <span>
              <i class="ti ti-calendar-event"></i>
            </span>
            <span class="hide-menu">Appointment</span>
            <i class="ti ti-chevron-down arrow-icon"></i>
          </summary>
          <ul style="padding-left: 1rem; list-style: none;">
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.appointment.index')}}">
                <span class="hide-menu">Appointment Table</span>
              </a>
            </li>
          </ul>
        </details>
      </li>
      

      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">AUTH</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin.logout')}}" aria-expanded="false">
          <span>
            <i class="ti ti-logout"></i>
          </span>
          <span class="hide-menu">Logout</span>
        </a>
      </li>
      
    </ul>
    
{{--     
<!-- تضمين Bootstrap JS (مطلوب لتفعيل الـ collapse) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
  </nav>