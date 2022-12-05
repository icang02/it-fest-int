<section id="places">

  <div class="container">
    <div class="row flex-md-center">
      <div class="col-md-11 col-lg-4 py-md-3 px-4 px-md-3 px-lg-0 px-xl-2 order-lg-1">
        <h1 class="fw-bold fs-md-3 fs-xl-5">Tempat Wisata Unggulan</h1>
        <hr class="text-primary my-4 my-lg-3 my-xl-4" style="height:3px; width:70px;" />
        <p class="lh-lg">
          Bagi anda yang masih bingung mau liburan kemana, cobalah untuk menikmati 
          tempat wisata yang sering dikunjungi oleh wisatawan lain. Inilah beberapa rekomendasi tempat 
          wisata unggulan di Sulawesi Tenggara.
        </p>

        <a class="btn btn-lg btn-primary hover-top" onclick="window.location.href='{{ url('/semua-wisata') }}'"
          role="button">Lainnya</a>

      </div>
      <div class="col-lg-8 order-lg-0 order-1 px-4 px-md-3 py-8 py-md-3">
        <div class="carousel slide" id="carouselExampleControlsNoTouching" data-bs-touch="false"
          data-bs-interval="false">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row h-100">

                @php
                  $allWisata = App\Models\TourPlace::take(3)
                      ->orderBy('terjual', 'DESC')
                      ->get();
                @endphp

                @foreach ($allWisata as $wisata)
                  <div class="col-md-4 mb-3 mb-md-0">
                    <a onclick="window.location.href='{{ 'semua-wisata/' . $wisata->id }}'"
                      class="card h-100 text-white hover-top" style="cursor: pointer;">
                      <div
                        style="background-image: url({{ asset("storage/$wisata->image") }}) ;height: 303px; background-size: cover; background-position: center;">
                      </div>
                      <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                        <div class="pt-3"><span class="badge bg-primary">
                            Rp {{ number_format($wisata->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="ps-3 d-flex justify-content-between align-items-center">
                          <h5 class="text-white">{{ $wisata->name }}</h5>
                          <h6 class="text-600">{{ $wisata->city }}</h6>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach

              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>
