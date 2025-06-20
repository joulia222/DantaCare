<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}">Denta<span>Care</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        @if (Auth::guard('patient')->check())
      
        <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
          <a href="{{ route('index') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#services" class="nav-link">Services</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#specialization" class="nav-link">Specialization</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#doctors" class="nav-link">Doctors</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#consultations" class="nav-link">Consultations</a>
        </li>
        <li class="nav-item {{ request()->routeIs('patient.medical-records') ? 'active' : '' }}">
          <a href="{{ route('patient.medical-records') }}" class="nav-link">Medical Record</a>
        </li>
        <li class="nav-item cta">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#modalRequest">
            <span>Make an Appointment</span>
          </a>
        </li>
      
        <!-- User Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('Image/' . Auth::guard('patient')->user()->img ?? 'images/user-avatar.png') }}" class="rounded-circle" width="30" height="30" alt="User Avatar">
            <span class="ml-2">{{ Auth::guard('patient')->user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('patient.profile.edit') }}">Edit Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('patient.resetPassword.page') }}">Reset Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('patient.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('patient.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      
        @else
      
        <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
          <a href="{{ route('index') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#services" class="nav-link">Services</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#specialization" class="nav-link">Specialization</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('index') }}#doctors" class="nav-link">Doctors</a>
        </li>
        <li class="nav-item cta">
          <a href="{{ route('patient.register.page') }}" class="nav-link">
            <span>Sign up</span>
          </a>
        </li>
        <li class="nav-item cta">
          <a href="{{ route('patient.login.page') }}" class="nav-link">
            <span>Make an Appointment</span>
          </a>
        </li>
      
        @endif
      </ul>
      
    </div>
  </div>
</nav>
<!-- END nav -->