<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ url('/home') }}">
      <img src="{{ asset('img/logo.png') }}"  alt="TUTAJ LOGO" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">


      @if(Auth::check())
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text d-none d-md-inline-flex">
                  <span>{{ Auth::user()->name }}</span>
              </span> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="dropdown-item" href="/profile/show">
                Profil
            </a>
            <a class="dropdown-item" href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Wyloguj
            </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu icon-menu"></span>
    </button>
      @endif
  </div>
</nav>
