<section class="py-0">

  <div
    style="background-image: url({{ asset('sneat/img/kategori/bg-order.jpg') }}); background-size: cover; background-position: center; height: 450px;">
  </div>

  <div class="container position-relative">
    <div class="row align-items-center min-vh-25">
      <div class="col-md-12 col-lg-12 text-center text-md-start" style="margin-top: -65px;">

        <div class="card border shadow-lg p-lg-4 p-3" style="border-radius: 30px;">
          <div class="card-body">
            <h2 class="fw-bold text-center">List <span class="text-primary">Order</span></h2>
            <hr style="height: 2px; width: 170px; border-radius: 5px;" class="mt-3 mb-5 mx-auto bg-primary">

            <div class="row text-center">
              <p>Dalam menu List Orders, Anda dapat melihat dan mengatur detail orderan Anda. Anda dapat melihat status
                orderan Anda di sini</p>
            </div>
            <hr style=" height:1px;" class=" mt-1 mb-5 mx-auto ">

            <div class="row">
              <div class="nav-align-top">
                <ul class="nav nav-pills mb-3" role="tablist">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                      data-bs-target="#all-orders" aria-controls="all-orders" aria-selected="true">
                      All Orders
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                      data-bs-target="#completed-order" aria-controls="completed-order" aria-selected="false">
                      Completed
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                      data-bs-target="#cancelled-order" aria-controls="cancelled-order" aria-selected="false">
                      Cancelled
                    </button>
                  </li>
                </ul>
                <div class="tab-content">
                  <style>
                    ::placeholder {
                      color: rgba(0, 0, 0, 0.474) !important;
                    }

                    .form-control {
                      border-radius: 6px;
                      color: rgba(0, 0, 0, 0.7) !important;
                    }

                    .input-group-text {
                      border-radius: 6px;
                    }
                  </style>
                  {{-- Ini bagian all orders --}}
                  <div class="tab-pane fade show active" id="all-orders" role="tabpanel">
                    <div class="row">
                      <div class="col-lg-4 mb-3">
                        <div class="input-group">
                          <span class="input-group-text" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                              fill="rgba(0, 0, 0, 0.474)" class="bi bi-search" viewBox="0 0 16 16">
                              <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                              </path>
                            </svg>
                          </span>
                          <input wire:model="searchAllOrders" type="search" class="form-control hj shadow"
                            placeholder="Cari order">
                        </div>
                      </div>
                      <div class="col-lg-2 mb-3">
                        <button class="btn btn-secondary shadow" style="width: 100%">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                              d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />
                            <path fill-rule="evenodd"
                              d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z" />
                          </svg>
                          Export
                        </button>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>No Order</th>
                                <th>Customer</th>
                                <th>Order</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Aksi</th>
                            </thead>
                            </tr>

                            <tbody>
                              @if ($wisataOrder->count() != 0 || $eventOrder->count() != 0)
                                @foreach ($wisataOrder as $item)
                                  <tr>
                                    <td>{{ $item->no_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tour_place->name }}</td>
                                    <td>
                                      {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                      @if ($item->status == 'pending')
                                        <span class="btn-sm btn-warning text-white">Pending</span>
                                      @elseif ($item->status == 'selesai')
                                        <span class="btn-sm btn-success">Selesai</span>
                                      @else
                                        <span class="btn-sm btn-danger">Gagal</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if (is_null($item->image_tf))
                                        Not Paid
                                      @else
                                        Payment
                                      @endif
                                    </td>
                                    <td class="text-nowrap">
                                      <button wire:click="getOrderId({{ $item->id }})"
                                        class="btn-sm btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $item->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                          fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                          <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                      </button>
                                      @if ($item->status == 'pending' && $item->image_tf != null)
                                        <button class="btn-sm btn btn-danger disabled">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path
                                              d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                          </svg>
                                        </button>
                                      @else
                                        <button onclick="confirm('Hapus order?') || event.stopImmediatePropagation()"
                                          wire:click="deleteOrder({{ $item->id }}, 'wisata')"
                                          class="btn-sm btn btn-danger">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path
                                              d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                          </svg>
                                        </button>
                                      @endif
                                    </td>
                                  </tr>

                                  {{-- Modal detail order --}}
                                  <div wire:ignore.self class="modal fade" id="modal{{ $item->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">No. Order
                                            {{ $item->no_order }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Nama wisata</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $item->tour_place->name }}</h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Jumlah tiket</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $item->quantity }}
                                            </h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Tanggal pemesanan</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $item->created_at }}
                                            </h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Total pembayaran</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              Rp {{ number_format($item->total_payment, 0, ',', '.') }}</h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">No. Rek Tujuan</h6>
                                            @php
                                              $noRek = App\Models\User::find($item->tour_place->id)->no_rek;
                                            @endphp
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $noRek }}
                                            </h6>
                                          </div>
                                          <hr>

                                          <div class="mt-2">
                                            {{-- @if ($item->status == 'pending' || $item->status == 'selesai') --}}
                                            <h6 class="fw-bold">Upload bukti transfer</h6>
                                            @if ($image)
                                              <img src="{{ $image->temporaryUrl() }}" alt="transfer"
                                                class="img-fluid my-1">
                                            @elseif (file_exists('storage/' . $item->image_tf) && $item->image_tf != null)
                                              <img src="{{ asset("storage/$item->image_tf") }}" alt="transfer"
                                                class="img-fluid my-1">
                                            @endif
                                            {{-- @endif --}}
                                            @if ($item->status == 'pending')
                                              <form wire:submit.prevent="uploadImage('wisata')">
                                                <div class="input-group mt-3">
                                                  <input wire:model="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    accept="image/*">
                                                  <button class="btn btn-primary" wire:loading.class="disabled"
                                                    type="submit"> Kirim </button>
                                                  @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                                </div>
                                              </form>
                                            @endif
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>

                                          @if ($item->image_tf == null && $item->status == 'pending')
                                            <button
                                              onclick="confirm('Batalkan order?') || event.stopImmediatePropagation()"
                                              wire:click="cancelOrder({{ $item->id }}, 'wisata')" type="button"
                                              class="btn btn-danger" data-bs-dismiss="modal">Batalkan
                                              order</button>
                                          @elseif ($item->status == 'selesai')
                                            <form action="{{ url("/invoice/$item->id/wisata") }}" method="post">
                                              @csrf
                                              <button type="submit" class="btn btn-success">Unduh Invoice</button>
                                            </form>
                                          @endif

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach

                                @foreach ($eventOrder as $item)
                                  <tr>
                                    <td>{{ $item->no_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->event->name }}</td>
                                    <td>
                                      {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                      @if ($item->status == 'pending')
                                        <span class="btn-sm btn-warning text-white">Pending</span>
                                      @elseif ($item->status == 'selesai')
                                        <span class="btn-sm btn-success">Selesai</span>
                                      @else
                                        <span class="btn-sm btn-danger">Gagal</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if (is_null($item->image_tf))
                                        Not Paid
                                      @else
                                        Payment
                                      @endif
                                    </td>
                                    <td class="text-nowrap">
                                      <button wire:click="getOrderId({{ $item->id }})"
                                        class="btn-sm btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalEvent{{ $item->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                          fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                          <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                      </button>
                                      @if ($item->status == 'pending' && $item->image_tf != null)
                                        <button class="btn-sm btn btn-danger disabled">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path
                                              d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                          </svg>
                                        </button>
                                      @else
                                        <button onclick="confirm('Hapus order?') || event.stopImmediatePropagation()"
                                          wire:click="deleteOrder({{ $item->id }}, 'event')"
                                          class="btn-sm btn btn-danger">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path
                                              d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                          </svg>
                                        </button>
                                      @endif
                                    </td>
                                  </tr>

                                  {{-- Modal detail event order --}}
                                  <div wire:ignore.self class="modal fade" id="modalEvent{{ $item->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">No. Order
                                            {{ $item->no_order }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Nama wisata</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $item->event->name }}</h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Jumlah tiket</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $item->quantity }}
                                            </h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Tanggal pemesanan</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $item->created_at }}
                                            </h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">Total pembayaran</h6>
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              Rp {{ number_format($item->total_payment, 0, ',', '.') }}</h6>
                                          </div>
                                          <div class="row mb-1">
                                            <h6 style="width: 40%;">No. Rek Tujuan</h6>
                                            @php
                                              $noRek = App\Models\Event::find($item->event_id)->user->no_rek;
                                            @endphp
                                            <h6 class="text-dark fw-bold" style="width: 60%;">: &nbsp;
                                              {{ $noRek }}
                                            </h6>
                                          </div>
                                          <hr>

                                          <div class="mt-2">
                                            {{-- @if ($item->status == 'pending' || $item->status == 'selesai') --}}
                                            <h6 class="fw-bold">Upload bukti transfer</h6>
                                            @if ($image)
                                              <img src="{{ $image->temporaryUrl() }}" alt="transfer"
                                                class="img-fluid my-1">
                                            @elseif (file_exists('storage/' . $item->image_tf) && $item->image_tf != null)
                                              <img src="{{ asset("storage/$item->image_tf") }}" alt="transfer"
                                                class="img-fluid my-1">
                                            @endif
                                            {{-- @endif --}}
                                            @if ($item->status == 'pending')
                                              <form wire:submit.prevent="uploadImage('event')">
                                                <div class="input-group mt-3">
                                                  <input wire:model="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    accept="image/*">
                                                  <button class="btn btn-primary" wire:loading.class="disabled"
                                                    type="submit"> Kirim </button>
                                                  @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                                </div>
                                              </form>
                                            @endif
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>

                                          @if ($item->image_tf == null && $item->status == 'pending')
                                            <button
                                              onclick="confirm('Batalkan order?') || event.stopImmediatePropagation()"
                                              wire:click="cancelOrder({{ $item->id }}, 'event')" type="button"
                                              class="btn btn-danger" data-bs-dismiss="modal">Batalkan
                                              order</button>
                                          @elseif ($item->status == 'selesai')
                                            <form action="{{ url("/invoice/$item->id/event") }}" method="post">
                                              @csrf
                                              <button type="submit" class="btn btn-success">Unduh Invoice</button>
                                            </form>
                                          @endif

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              @else
                                <tr class="text-center">
                                  <td colspan="7">Belum ada orderan.</td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- ini bagian completed --}}
                  <div class="tab-pane fade" id="completed-order" role="tabpanel">
                    <div class="row">
                      <div class="col-lg-4 mb-3">
                        <div class="input-group">
                          <span class="input-group-text" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                              fill="rgba(0, 0, 0, 0.474)" class="bi bi-search" viewBox="0 0 16 16">
                              <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                              </path>
                            </svg>
                          </span>
                          <input wire:model="searchSelesai" type="search" class="form-control shadow"
                            placeholder=" Cari Order">
                        </div>
                      </div>
                      <div class="col-lg-2 mb-3">
                        <button class="btn btn-secondary shadow" style="width: 100%">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                              d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />
                            <path fill-rule="evenodd"
                              d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z" />
                          </svg>
                          Export
                        </button>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>No Order</th>
                                <th>Customer</th>
                                <th>Order</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </thead>
                            </tr>

                            <tbody>
                              @php
                                $status = 'selesai';
                                $wisataSelesai = App\Models\UserOrder::where('no_order', 'like', '%' . $this->searchSelesai . '%')
                                    ->where('status', $status)
                                    ->get();
                                $eventSelesai = App\Models\UserEventOrder::where('no_order', 'like', '%' . $this->searchSelesai . '%')
                                    ->where('status', $status)
                                    ->get();
                              @endphp
                              @if ($wisataSelesai->count() != 0 || $eventSelesai->count() != 0)
                                @foreach ($wisataSelesai as $item)
                                  <tr>
                                    <td>{{ $item->no_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tour_place->name }}</td>
                                    <td>
                                      {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                      @if ($item->status == 'pending')
                                        <span class="btn-sm btn-warning text-white">Ditunda</span>
                                      @elseif ($item->status == 'selesai')
                                        <span class="btn-sm btn-success">Selesai</span>
                                      @else
                                        <span class="btn-sm btn-danger">Gagal</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($item->status == 'selesai')
                                        Payment
                                      @else
                                        Not Paid
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                                @foreach ($eventSelesai as $item)
                                  <tr>
                                    <td>{{ $item->no_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->event->name }}</td>
                                    <td>
                                      {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                      @if ($item->status == 'pending')
                                        <span class="btn-sm btn-warning text-white">Ditunda</span>
                                      @elseif ($item->status == 'selesai')
                                        <span class="btn-sm btn-success">Selesai</span>
                                      @else
                                        <span class="btn-sm btn-danger">Gagal</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($item->status == 'selesai')
                                        Payment
                                      @else
                                        Not Paid
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                <tr class="text-center">
                                  <td colspan="6">Belum ada orderan.</td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- ini bagian cancelled --}}
                  <div class="tab-pane fade" id="cancelled-order" role="tabpanel">
                    <div class="row">
                      <div class="col-lg-4 mb-3">
                        <div class="input-group">
                          <span class="input-group-text" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                              fill="rgba(0, 0, 0, 0.474)" class="bi bi-search" viewBox="0 0 16 16">
                              <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                              </path>
                            </svg>
                          </span>
                          <input wire:model="searchGagal" type="search" class="form-control shadow"
                            placeholder=" Cari Order">
                        </div>
                      </div>
                      <div class="col-lg-2 mb-3">
                        <button class="btn btn-secondary shadow" style="width: 100%">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                              d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />
                            <path fill-rule="evenodd"
                              d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z" />
                          </svg>
                          Export
                        </button>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>No Order</th>
                                <th>Customer</th>
                                <th>Order</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </thead>
                            </tr>

                            <tbody>
                              @php
                                $status = 'gagal';
                                $wisataGagal = App\Models\UserOrder::where('no_order', 'like', '%' . $this->searchGagal . '%')
                                    ->where('status', $status)
                                    ->get();
                                $eventGagal = App\Models\UserEventOrder::where('no_order', 'like', '%' . $this->searchGagal . '%')
                                    ->where('status', $status)
                                    ->get();
                              @endphp
                              <h2>{{ $searchGagal }}</h2>
                              @if ($wisataGagal->count() != 0 || $eventGagal->count() != 0)
                                @foreach ($wisataGagal as $item)
                                  <tr>
                                    <td>{{ $item->no_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tour_place->name }}</td>
                                    <td>
                                      {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                      @if ($item->status == 'pending')
                                        <span class="btn-sm btn-warning text-white">Ditunda</span>
                                      @elseif ($item->status == 'selesai')
                                        <span class="btn-sm btn-success">Selesai</span>
                                      @else
                                        <span class="btn-sm btn-danger">Gagal</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($item->status == 'selesai')
                                        Payment
                                      @else
                                        Not Paid
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                                @foreach ($eventGagal as $item)
                                  <tr>
                                    <td>{{ $item->no_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->event->name }}</td>
                                    <td>
                                      {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                      @if ($item->status == 'pending')
                                        <span class="btn-sm btn-warning text-white">Ditunda</span>
                                      @elseif ($item->status == 'selesai')
                                        <span class="btn-sm btn-success">Selesai</span>
                                      @else
                                        <span class="btn-sm btn-danger">Gagal</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($item->status == 'selesai')
                                        Payment
                                      @else
                                        Not Paid
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                <tr class="text-center">
                                  <td colspan="6">Belum ada orderan.</td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            {{-- Start Pagintaion --}}
            {{-- <div class="mt-lg-4 mt-0 mx-auto">
              {{ $allWisata->onEachSide(0.5)->withQueryString()->links() }}
            </div> --}}
            {{-- End Pagination --}}

          </div>
        </div>


      </div>
    </div>
  </div>
</section>
