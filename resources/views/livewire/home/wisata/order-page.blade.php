<section class="py-0">

  <div
    style="background-image: url({{ asset("storage/$wisata->image") }}); background-size: cover; background-position: center; height: 450px;">
  </div>

  <div class="container position-relative">
    <div class="row align-items-center min-vh-25">
      <div class="col-md-12 col-lg-12 text-center text-md-start" style="margin-top: -65px;">

        <div class="card border shadow-lg p-lg-4 pt-lg-4 p-0 pt-3 pb-3" style="border-radius: 30px;">
          <div class="card-body">
            <h2 class="fw-bold text-center">Wisata <span class="text-primary">Checkout</span></h2>
            <h6 class="text-center px-3">Harga tiket dapat berubah sewaktu-waktu</h6>

            <hr class="mt-5" style="height: 2px;">

            <div class="row gy-lg-4 gy-4 mt-3 text-start position-lg-relative">
              <div class="col-md-7">
                <div class="card border px-2">
                  <div class="card-body">

                    <div class="d-flex justify-content-between">
                      <span class="fw-bold">WISATA</span>
                      <span>Detail</span>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-12" style="text-align: justify;">
                        <h6 class="fw-bold">Deskripsi Singkat</h6>
                        <h6>{{ str()->limit($description, '300') }}</h6>
                      </div>
                    </div>

                  </div>
                </div>

                <hr class="my-lg-4 mb-0 mt-4">
              </div>

              <div class="col-md-5 position-lg-absolute" style="right: 0;">
                <div class="card border px-2">
                  <div class="card-body">

                    <div class="d-flex justify-content-between">
                      <span class="fw-bold">{{ $qty }} ITEM</span>
                      <span>Detail</span>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-lg-4 col-5">
                        <img src="{{ asset("storage/$image") }}" alt="Image" class="img-fluid"
                          style=" 
                          height: 105px; 
                          object-fit: cover;
                          object-position: 25% 25%;">
                      </div>
                      <div class="col-lg-8 col-7 ps-0">
                        <h6 class="fw-bold">Rp {{ number_format($price, 0, ',', '.') }}</h6>
                        <h6>{{ $name }}, {{ $address }}</h6>
                        <h6 class="fw-bold">{{ $city }}</h6>
                        <h6>Qty: <span class="fw-bold">{{ $qty }}</span></h6>
                      </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <h6>Subtotal</h6>
                      <h6>Rp {{ number_format($total, 0, ',', '.') }}</h6>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                      <h6 class="fw-bold" style="font-size: 1rem;">TOTAL PEMBAYARAN</h6>
                      <h6 class="fw-bold" style="font-size: 1rem;">Rp {{ number_format($paymentTotal, 0, ',', '.') }}
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- <hr class="my-5"> --}}

            <div class="row text-start mt-lg-0 mt-5">
              <div class="col-lg-7">
                <div class="card border" style="border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;">
                  <div class="card-body" style="line-height: 30px;">
                    <table>
                      <tr>
                        <td>
                          <h6>Nama customer</h6>
                        </td>
                        <td class="text-center" style="width: 20px">:</td>
                        <td class="ps-1">
                          <h6 class="fw-bold text-uppercase">{{ auth()->user()->name }}</h6>
                        </td>
                      </tr>
                      <tr>
                        <td class>
                          <h6>Metode pembayaran</h6>
                        </td>
                        <td class="text-center">
                          <h6>:</h6>
                        </td>
                        <td class="ps-1">
                          <h6 class="fw-bold text-uppercase">Bank Transfer</h6>
                        </td>
                      </tr>
                      <tr>
                        <td class>
                          <h6>No. rekening tujuan</h6>
                        </td>
                        <td class="text-center">
                          <h6>:</h6>
                        </td>
                        <td class="ps-1">
                          <h6 class="fw-bold text-uppercase">{{ $noRek }}</h6>
                        </td>
                      </tr>
                    </table>

                  </div>
                  <div class="d-flex">
                    <div wire:click="checkoutConfirm" class="btn w-75 btn-primary mt-2 me-1"
                      style="border-top-left-radius: 0; border-top-right-radius: 0; ">
                      Checkout</div>
                    <a href="{{ url("/semua-wisata/$wisataId") }}" class="btn w-50 btn-danger mt-2"
                      style="border-top-left-radius: 0; border-top-right-radius: 0; ">
                      Kembali</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>
