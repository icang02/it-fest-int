<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Checkout </h4>
  <div class="row px-md-4 px-1">
    <div class="col-md-12">
      <div class="card">
        <h6 class="card-header text-light"> Harga dapat
          berubah berdasarkan
          promosi / nilai tukar uang. Beberapa item
          mungkin tidak ada stok. </h6>
        <div class="table-responsive text-nowrap pb-3">
          <table class="table table-borderless">
            <thead>
              <tr class="fw-bold">
                <th style="width: 10%;">Item</th>
                <th style="max-width: 60%;"></th>
                <th class="text-end" style="width: 10%;">Harga</th>
                <th class="text-end" style="width: 10%;">Jumlah</th>
                <th class="text-end" style="width: 10%;">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <img src="{{ asset('sneat/img/wisata/thumb/pantai-nambo.jpg') }}" alt="thumbnail.jpg" width="110">
                </td>
                <td>
                  <span class="fw-bold">
                    <a class="text-dark" href="#"> {{ $cart->tour_place->name }} </a>
                  </span> <br>
                  <span> {{ $cart->tour_place->city }} </span>
                  <br>
                  <span> {{ $cart->tour_place->address }} </span>
                </td>
                <td class="text-end"> Rp {{ $cart->tour_place->price }}</td>
                <td class="text-end"> {{ $cart->quantity }} </td>
                <td class="text-end"> Rp {{ $cart->total_payment }} </td>
              </tr>
              <tr>
                <td colspan="5">
                  <hr>
                </td>
              </tr>
              <tr>
                <td colspan="3"><a class="btn btn-sm btn-success" href="http://sultraspot.herokuapp.com/list-wisata">
                    Lihat Semua Wisata </a></td>
                <td class="fw-bold">Diskon</td>
                <td class="text-end fw-bold">-</td>
              </tr>
              @if ($cart->tour_place->rental)
                <tr>
                  <td colspan="3"></td>
                  <td>Sewa Kamera</td>
                  <td class="text-end"> Rp {{ $cart->price_kamera }} </td>
                </tr>
              @endif
              <tr>
                <td colspan="3"></td>
                <td class="fw-bold">Total (IDR)</td>
                <td class="text-end fw-bold"> Rp {{ $cart->total_payment + $cart->price_kamera }} </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row px-md-4 px-1 mt-4 justify-content-end">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="fs-5 fw-bold text-primary"> Total : Rp {{ $cart->total_payment + $cart->price_kamera }} </div><br>
          <div><button class="btn btn-lg btn-success fw-bold fs-5"> CHECKOUT </button></div>
        </div>
      </div>
    </div>
  </div>

  <hr class="my-5">
</div>
