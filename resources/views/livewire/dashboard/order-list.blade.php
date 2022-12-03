<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> Order </h4>

  @if ($orderList->count() != 0 || $orderEventList->count() != 0)
    <div class="card">
      <h5 class="card-header">Order Table</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>No. Order</th>
              <th>Item Name</th>
              <th class="text-center">Total</th>
              <th class="text-center">Status</th>

              @if (Auth()->user()->role_id == 3)
                <th class="text-center">Confirm / Cancel</th>
              @endif

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

                <td class="text-center">
                  @if ($order->status == 'pending')
                    <span class="badge bg-label-warning me-1"> Proses </span>
                  @elseif ($order->status == 'pending')
                    <span class="badge bg-label-warning me-1"> {{ $order->status }} </span>
                  @elseif ($order->status == 'selesai')
                    <span class="badge bg-label-success me-1"> {{ $order->status }} </span>
                  @else
                    <span class="badge bg-label-danger me-1"> {{ $order->status }} </span>
                  @endif
                </td>

                @if (Auth()->user()->role_id == 3)
                  <td class="text-center">
                    @if ($order->status == 'selesai')
                      <button class="btn btn-success btn-sm">Success</button>
                    @elseif ($order->status == 'gagal')
                      <button class="btn btn-danger btn-sm">Failed</button>
                    @else
                      <button wire:click="confirmOrder({{ $order->id }})"
                        class="btn btn-success btn-sm">Confirm</button>
                      <button wire:click="cancelOrder({{ $order->id }})"
                        class="btn btn-danger btn-sm">Cancel</button>
                    @endif
                  </td>
                @endif

                <td>
                  <a class="btn btn-sm btn-primary" href="{{ url("order/$order->id") }}"> Detail </a>
                  @if (auth()->user()->role_id == 3 && $order->image_tf != null)
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                      data-bs-target="#bukti-tf{{ $order->id }}">
                      See Evidence of transfer
                    </button>
                  @endif

                  @if (Auth::user()->role_id == 3 && $order->image_tf_public_id)
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal"
                      data-bs-whatever="@mdo">Evidence of transfer</button>
                  @endif

                  @if (is_null($order->image_tf_public_id) && Auth()->user()->role_id == 2 && $order->status == 'pending')
                    <button
                      wire:click="confirmDelete({{ $order->id }}, 'wisata')"class="btn btn-sm btn-danger">Cancel</button>
                  @endif
                </td>
              </tr>

              {{-- Modal Start --}}
              <div wire:ignore.self class="modal fade" id="bukti-tf{{ $order->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Evidence of transfer</h5>
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
              {{-- Modal End --}}
            @endforeach
            {{-- End Wisata Order --}}

            {{-- Start orderEventList --}}
            @foreach ($orderEventList as $order)
              <tr>
                <td>
                  <i class="fab fa-angular fa-lg text-danger me-3"></i>
                  <strong> {{ $order->no_order }} </strong>
                </td>
                <td> {{ $order->event->name }} </td>
                <td class="text-end">
                  Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                </td>

                <td class="text-center">
                  @if ($order->status == 'pending')
                    <span class="badge bg-label-warning me-1"> Proses </span>
                  @elseif ($order->status == 'pending')
                    <span class="badge bg-label-warning me-1"> {{ $order->status }} </span>
                  @elseif ($order->status == 'selesai')
                    <span class="badge bg-label-success me-1"> {{ $order->status }} </span>
                  @else
                    <span class="badge bg-label-danger me-1"> {{ $order->status }} </span>
                  @endif
                </td>

                @if (Auth()->user()->role_id == 3)
                  <td class="text-center">
                    @if ($order->status == 'selesai')
                      <button class="btn btn-success btn-sm">Success</button>
                    @elseif ($order->status == 'gagal')
                      <button class="btn btn-danger btn-sm">Failed</button>
                    @else
                      <button wire:click="confirmOrder({{ $order->id }})"
                        class="btn btn-success btn-sm">Confirm</button>
                      <button wire:click="cancelOrder({{ $order->id }})"
                        class="btn btn-danger btn-sm">Cancel</button>
                    @endif
                  </td>
                @endif

                <td>
                  <a class="btn btn-sm btn-primary" href="{{ url("order/event/$order->id") }}"> Detail </a>
                  @if (auth()->user()->role_id == 3 && $order->image_tf != null)
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                      data-bs-target="#bukti-tf{{ $order->id }}">
                      See Evidence of transfer
                    </button>
                  @endif

                  @if (Auth::user()->role_id == 3 && $order->image_tf_public_id)
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal"
                      data-bs-whatever="@mdo">Evidence of transfer</button>
                  @endif

                  @if (is_null($order->image_tf_public_id) && Auth()->user()->role_id == 2 && $order->status == 'pending')
                    <button
                      wire:click="confirmDelete({{ $order->id }},'event')"class="btn btn-sm btn-danger">Cancel</button>
                  @endif
                </td>
              </tr>

              {{-- Modal Start --}}
              <div wire:ignore.self class="modal fade" id="bukti-tf{{ $order->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Evidence of transfer</h5>
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
              {{-- Modal End --}}
            @endforeach
            {{-- End orderEventList --}}

          </tbody>
        </table>
      </div>
    </div>
  @else
    <div>
      @if (Auth::user()->role_id == 2)
        <h4 class="text-light text-center"> No order yet please make an order 😜 </h4>
      @else
        <h4 class="text-light text-center"> No orders yet 😢 </h4>
      @endif
    </div>
  @endif
  <hr class="my-5">
</div>
