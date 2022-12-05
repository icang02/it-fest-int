<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> Wisata Order </h4>

  @if ($orderList->count() != 0)
    <div class="card">
      <h5 class="card-header">Tabel Data Order</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>No. Order</th>
              <th>Item Name</th>
              <th class="text-center">Total</th>
              <th class="text-center">Status</th>
              <th class="text-center">Confirm / Cancel</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            {{-- Start Wisata Order --}}
            @foreach ($orderList as $order)
              <tr>
                <td>
                  <i class="fab fa-angular fa-lg text-danger me-3"></i>
                  <strong> {{ $order->no_order }} </strong>
                </td>
                <td> {{ $order->tour_place->name }} </td>
                <td class="text-end">
                  Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                </td>

                @php
                  $kosong = 'false';
                  foreach ($getData as $data) {
                      if ($data->no_order == $order->no_order) {
                          $kosong = 'true';
                      }
                  }
                @endphp
                <td class="text-center">
                  @if ($order->status == 'pending' && $kosong == 'true')
                    <span class="badge bg-label-warning me-1"> Pending </span>
                  @elseif ($order->status == 'selesai')
                    <span class="badge bg-label-success me-1"> Selesai </span>
                  @elseif ($order->status == 'gagal' || $kosong == 'false')
                    <span class="badge bg-label-danger me-1"> Gagal </span>
                  @endif
                </td>

                <td class="text-center">
                  @if ($order->status == 'selesai')
                    <button class="btn btn-success btn-sm">Success</button>
                  @elseif ($order->status == 'gagal' || $kosong == 'false')
                    <button class="btn btn-danger btn-sm">Cancel</button>
                  @elseif ($order->status == 'pending' && $kosong == 'true')
                    <button wire:click="confirmOrder({{ $order->id }})"
                      class="btn btn-success btn-sm">Confirm</button>
                    <button wire:click="cancelOrder({{ $order->id }})" class="btn btn-danger btn-sm">Cancel</button>
                  @endif
                </td>

                <td>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#detail{{ $order->id }}">Detail</button>


                  <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                    @if ($order->image_tf == null) disabled @else data-bs-target="#bukti-tf{{ $order->id }}" @endif>Bukti
                    Transfer</button>

                  <button @if ($order->status == 'pending' && $kosong == 'true') disabled @endif
                    wire:click="confirmDelete({{ $order->id }}, 'wisata')" class="btn btn-sm btn-danger">
                    Hapus
                  </button>
                </td>
              </tr>

              {{-- Modal Detail Event Order --}}
              <div wire:ignore.self class="modal fade" id="detail{{ $order->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">No. Order
                        {{ $order->no_order }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                      <div class="row mb-1">
                        <h6 style="width: 40%;">Nama wisata</h6>
                        <h6 class="text-dark lead" style="width: 60%;">: &nbsp;
                          {{ $order->tour_place->name }}</h6>
                      </div>
                      <div class="row mb-1">
                        <h6 style="width: 40%;">Tanggal pemesanan</h6>
                        <h6 class="text-dark lead" style="width: 60%;">: &nbsp;
                          {{ $order->created_at }}
                        </h6>
                      </div>
                      <div class="row mb-1">
                        <h6 style="width: 40%;">Jumlah tiket</h6>
                        <h6 class="text-dark lead" style="width: 60%;">: &nbsp;
                          {{ $order->quantity }}
                        </h6>
                      </div>
                      <div class="row mb-1">
                        <h6 style="width: 40%;">Harga Tiket</h6>
                        <h6 class="text-dark lead" style="width: 60%;">: &nbsp;
                          Rp {{ number_format($order->tour_place->price, 0, ',', '.') }}
                        </h6>
                      </div>
                      <div class="row mb-1">
                        <h6 style="width: 40%;">Total pembayaran</h6>
                        <h6 class="text-dark lead fw-bold" style="width: 60%;">: &nbsp;
                          Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                        </h6>
                      </div>
                      <hr>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>

                      @if ($order->status == 'selesai')
                        <button type="button" onclick="window.location.href='/invoice/{{ $order->id }}/wisata'"
                          class="btn btn-success">Unduh Invoice</button>
                      @endif

                    </div>
                  </div>
                </div>
              </div>

              {{-- Modal Start Bukti Transfer --}}
              <div wire:ignore.self class="modal fade" id="bukti-tf{{ $order->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Bukti transfer</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <img src="{{ "storage/$order->image_tf" }}" alt="nota.jpg" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            {{-- End Wisata Order --}}

          </tbody>
        </table>
      </div>
    </div>
  @else
    <div>
      <h4 class="text-light text-center"> No orders yet 😢 </h4>
    </div>
  @endif
  <hr class="my-5">
</div>
