<section class="py-0">

  <div
    style="background-image: url({{ asset('sneat/img/kategori/cover-wisata.jpg') }}); background-size: cover; background-position: center; height: 450px;">
  </div>

  <div class="container position-relative">
    <div class="row align-items-center min-vh-25">
      <div class="col-md-12 col-lg-12 text-center text-md-start" style="margin-top: -65px;">

        <div class="card border shadow-lg p-lg-4 p-3" style="border-radius: 30px;">
          <div class="card-body">
            <h2 class="fw-bold text-center">Event <span class="text-primary">SultraSpot</span></h2>
            <hr style="height: 2px; width: 170px; border-radius: 5px;" class="mt-3 mb-5 mx-auto bg-primary">

            <div class="row mb-4 justify-content-between">
              <div class="col-lg-3">
                <a href="{{ url('/') }}" class="btn btn-primary mb-lg-0 mb-3">Kembali</a>
              </div>
              <div class="col-lg-3 ms-auto">
                <style>
                  ::placeholder {
                    color: rgba(0, 0, 0, 0.474) !important;
                  }

                  .form-control {
                    border-radius: 6px;
                    border-color: rgba(0, 0, 0, 0.474) !important;
                  }
                </style>

                <input type="text" wire:model="search" class="form-control shadow text-secondary"
                  placeholder="Cari event ..">
              </div>
            </div>

            <div class="row gy-lg-4 gy-2 justify-content-center">

              @forelse ($allEvent as $event)
                <div class="col-md-6 mb-3 mb-md-0">
                  <a href="{{ url("semua-event/$event->id") }}" class="card h-100 text-white hover-top">
                    <div
                      style="background-image: url({{ asset("storage/$event->cover") }}); height: 250px; background-size: cover; background-position: center; border-radius: 10px;">
                    </div>
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">
                          Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                      </div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">{{ $event->name }}</h5>
                        <h6 class="text-600">{{ $event->city }} </h6>
                      </div>
                    </div>
                  </a>
                </div>
              @empty
                <div class="col-md-12 mb-3 mb-md-0 text-center">
                  <h5>Event tidak ditemukan.</h4>
                </div>
              @endforelse
            </div>

            <div class="mt-lg-4 mt-0 mx-auto">
              {{ $allEvent->onEachSide(0.5)->withQueryString()->links() }}
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>
</section>
