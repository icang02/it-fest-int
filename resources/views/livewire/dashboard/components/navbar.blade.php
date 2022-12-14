<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    {{-- Icon Cart --}}
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      {{-- @if (Gate::check('pengelola'))
        <li class="nav-item lh-1 me-3">
          <a class="d-flex align-items-center fw-bold color-primary" href="{{ route('orderList') }}">
            Order
            <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20 ms-1">
              {{ $orderCount }}
            </span>
          </a>
        </li>
      @endif --}}

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            @if (Auth()->user()->image_profil == null)
              <img src="{{ asset('sneat/img/avatars/profil.png') }}" alt class="w-px-40 h-auto rounded-circle" />
            @else
              <img src="{{ asset('storage/' . Auth()->user()->image_profil) }}" alt
                class="w-px-40 h-auto rounded-circle" />
            @endif
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="{{ route('profile') }}">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    @if (Auth()->user()->image_profil == null)
                      <img src="{{ asset('sneat/img/avatars/profil.png') }}" alt
                        class="w-px-40 h-auto rounded-circle" />
                    @else
                      <img src="{{ asset('storage/' . Auth()->user()->image_profil) }}" alt
                        class="w-px-40 h-auto rounded-circle" />
                    @endif
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block"> {{ auth()->user()->name }} </span>
                  <small class="text-muted"> {{ str()->title(auth()->user()->role->name) }} </small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('profile') }}">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          {{-- <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li> --}}
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <button wire:click="logout" class="dropdown-item">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </button>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>
