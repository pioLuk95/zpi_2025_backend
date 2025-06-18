
<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
      @if(Auth::check())
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
              <span class="mdi mdi-account-circle"></span>
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{Auth::user()->name}}</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">Manager</small>
              </a>
            </div>
          </div>
        </div>
          <a class="btn btn-success btn-block text-white" href="{{ route('patients.create') }}">Nowy pacjent <i class="mdi mdi-plus"></i>

          </a>
      </div>
    </li>
      @endif
    <li class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link" @if(Auth::check())href="{{ url('/home') }}"@endif>
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
      @if(Auth::check() && Auth::user()->role !== 'user')
      <li class="nav-item {{ active_class(['/']) }}">
          <a class="nav-link" @if(Auth::check())href="{{ url('/patients') }}"@endif>
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Pacjenci</span>
          </a>
      </li>
      @endif

      <li class="nav-item {{ active_class(['/']) }}">
          <a class="nav-link" @if(Auth::check())href="{{ url('/medications') }}"@endif>
              <i class="menu-icon mdi mdi-pill"></i>
              <span class="menu-title">Leki</span>
          </a>
      </li>
      <li class="nav-item {{ active_class(['/']) }}">
          <a class="nav-link" @if(Auth::check())href="{{ url('/locations') }}"@endif>
              <i class="menu-icon mdi mdi-hospital-building"></i>
              <span class="menu-title">Sale</span>
          </a>
      </li>

    @if(Auth::check() && Auth::user()->role === 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/roles') }}">
            <i class="menu-icon mdi mdi-account-key"></i>
            <span class="menu-title">Role</span>
        </a>
    </li>
    @endif

    {{--<li class="nav-item {{ active_class(['user-pages/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#user-pages" aria-expanded="{{ is_active_route(['user-pages/*']) }}" aria-controls="user-pages">
        <i class="menu-icon mdi mdi-lock-outline"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['user-pages/*']) }}" id="user-pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['user-pages/login']) }}">
            <a class="nav-link" href="{{ url('/user-pages/login') }}">Login</a>
          </li>
          <li class="nav-item {{ active_class(['user-pages/register']) }}">
            <a class="nav-link" href="{{ url('/user-pages/register') }}">Register</a>
          </li>
          <li class="nav-item {{ active_class(['user-pages/lock-screen']) }}">
            <a class="nav-link" href="{{ url('/user-pages/lock-screen') }}">Lock Screen</a>
          </li>
        </ul>
      </div>
    </li>--}}
  </ul>
</nav>
