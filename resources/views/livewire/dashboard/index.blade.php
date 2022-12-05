<div class="container-xxl flex-grow-1 container-p-y">

  {{-- Message Error --}}
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="row">
    {{-- col 12 --}}
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title color-primary">Hi, {{ auth()->user()->name }}! 👋</h5>
              <p class="mb-4">
                Welcome to Dashboard Page of SultraSpot.
              </p>

              <a href="{{ url('/semua-wisata') }}" target="_blank" class="btn btn-sm btn-outline-primary">See All
                Tours</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="{{ asset('sneat/img/illustrations/man-with-laptop-light.png') }}" height="140"
                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Col 6 --}}
    <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
      <div class="row">
        @can('admin')
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{ asset('sneat/img/icons/unicons/chart-success.png') }}" alt="chart success"
                      class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="{{ url('/admin') }}">Admin</a>
                      <a class="dropdown-item" href="{{ url('/pengunjung') }}">Pengunjung</a>
                      <a class="dropdown-item" href="{{ url('/pengelola') }}">Pengelola</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">User</span>
                <h3 class="card-title mb-2">{{ App\Models\User::all()->count() }}</h3>
                <small class="text-success fw-semibold">All Users</small>
              </div>
            </div>
          </div>
        @elsecan('pengelola')
          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{ asset('sneat/img/icons/unicons/chart-success.png') }}" alt="chart success"
                      class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="{{ url('/order') }}">View Order</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Tour</span>
                <h3 class="card-title mb-2">
                  {{ App\Models\PengelolaOrder::where('user_id', auth()->user()->id)->where('status', 'pending')->count() }}
                </h3>
                <small class="text-success fw-semibold">Incoming Tour Orders</small>
              </div>
            </div>
          </div>

          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{ asset('sneat/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                      class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="{{ url('/event-order') }}">View Order</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Event</span>
                <h3 class="card-title mb-2">
                  {{ App\Models\PengelolaEventOrder::where('user_id', auth()->user()->id)->where('status', 'pending')->count() }}
                </h3>
                <small class="text-success fw-semibold">Incoming Event Orders</small>
              </div>
            </div>
          </div>
        @endcan

        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  @can('admin')
                    <img src="{{ asset('sneat/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                      class="rounded" />
                  @elsecan('pengelola')
                    <img src="{{ asset('sneat/img/icons/unicons/cc-primary.png') }}" alt="Credit Card"
                      class="rounded" />
                  @endcan
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                    @can('admin')
                      <a class="dropdown-item" href="{{ url('/semua-wisata') }}" target="_blank">View More</a>
                    @elsecan('pengelola')
                      <a class="dropdown-item" href="{{ url('/wisata') }}">View Tour</a>
                    @endcan
                  </div>
                </div>
              </div>
              @can('admin')
                <span class="fw-semibold d-block mb-1">Tour</span>
                <h3 class="card-title mb-2">{{ App\Models\TourPlace::all()->count() }}</h3>
                <small class="text-success fw-semibold">All Tours</small>
              @elsecan('pengelola')
                <span class="fw-semibold d-block mb-1">Ticket</span>
                <h3 class="card-title mb-2">
                  {{ App\Models\TourPlace::where('id', auth()->user()->id)->select('terjual')->get()->first()->terjual }}
                </h3>
                <small class="text-success fw-semibold">Number of tickets sold</small>
              @endcan

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
