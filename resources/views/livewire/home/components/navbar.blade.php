<nav class="navbar navbar-expand-lg fixed-top py-3 backdrop bg-white" data-navbar-on-scroll="data-navbar-on-scroll">
  <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="{{ url('/') }}"> <img
        class="d-inline-block align-top img-fluid" src="{{ asset('sneat/img/favicon/logo.png') }}" alt=""
        width="50" /><span class="text-primary fs-4 ps-2">SultraSpot</span></a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
        <li class="nav-item"><a class="nav-link {{ request()->is('/') ?: 'text-600' }}"
            href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('semua-wisata*') ?: 'text-600' }}"
            href="{{ url('semua-wisata') }}">Wisata</a></li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('semua-event*') ?: 'text-600' }}" href="{{ url('/semua-event') }}">Event
          </a>
        </li>

        @can('pengunjung')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('semua-order*') ?: 'text-600' }}" href="{{ url('/semua-order') }}">Order
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('my-profile*') ?: 'text-600' }}" href="{{ url('/my-profile') }}">My
              Profile
            </a>
          </li>
        @endcan
      </ul>

      @guest
        <form class="ps-lg-5 mt-lg-0 mt-3">
          <a href="{{ route('login') }}" class="btn btn-lg btn-outline-primary order-0" type="submit">Sign In</a>
        </form>
      @endguest
      @auth
        @can('pengunjung')
          <form class="ps-lg-5 mt-lg-0 mt-3">
            <button wire:click="logout" class="btn btn-lg btn-outline-primary order-0" type="submit">Logout</button>
          </form>
        @else
          <div class="ps-lg-5 mt-lg-0 mt-3">
            <button class="btn btn-lg btn-outline-primary order-0"
              onclick="window.location.href='/dashboard'">Dashboard</button>
          </div>
        @endcan
      @endauth

    </div>
  </div>
</nav>
