<section class="py-0">
  <div class="bg-holder d-none d-md-block"
    style="background-image:url({{ asset('rhea') }}/img/illustrations/hero.png);background-position:right bottom;background-size:contain;">
  </div>
  <!--/.bg-holder-->

  <div class="container position-relative">
    <div class="row align-items-center min-vh-75 my-lg-8">
      <div class="col-md-7 col-lg-6 text-center text-md-start py-8">
        <h1 translate="no" class="mb-4 display-1 lh-sm">The Other Spot<br class="d-block d-lg-none d-xl-block" />of Sultra
        </h1>
        <p class="mt-4 mb-5 fs-1 lh-base">SultraSpot merupakan  sistem informasi tempat <br
            class="d-none d-lg-block" />wisata yang ada di Sulawesi Tenggara yang terintegrasi<br
            class="d-none d-lg-block" />dengan sistem pemesanan tiket sehingga dapat <br
            class="d-none d-lg-block" />mempermudah akses ke tempat wisata yang ada di Sultra
          </p>
        @guest
          <a class="btn btn-lg btn-primary hover-top" onclick="window.location.href='/login'" role="button">Pesan
            Sekarang</a>
        @endguest
        @auth
          <a class="btn btn-lg btn-primary hover-top" onclick="window.location.href='/semua-wisata'" role="button">Pesan
            Sekarang</a>
        @endauth
      </div>
    </div>
  </div>
</section>
