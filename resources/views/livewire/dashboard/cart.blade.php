<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> Cart </h4>

  @if ($carts->count() !== 0)
    <div class="card">
      <h5 class="card-header">Cart Table</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>No.</th>
              <th>Nama Tempat</th>
              <th>Jumlah Tiket</th>
              <th>Harga</th>
              <th class="text-center">Sewa Kamera</th>
              <th class="text-center">Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            @foreach ($carts as $key => $cart)
              {{-- Modal Update --}}
              <div class="col-lg-4 col-md-6">
                <div wire:ignore.self class="modal fade" id="smallModal{{ $cart->id }}" tabindex="-1"
                  aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                      <form wire:submit.prevent="updateCart({{ $cart->id }})">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel2"></h5><button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row g-2">
                            <div class="col mb-0">
                              <label class="form-label" for="quantity">Set number of tickets</label>
                              <input wire:model="qty" type="number" min="1" class="form-control" name="quantity"
                                id="quantity" max="{{ $cart->tour_place->ticket_stock }}">
                              @if ($cart->tour_place->rental)
                                <div class="form-check mt-2">
                                  <input wire:model="chkboxKamera" class="form-check-input" type="checkbox"
                                    name="rental" id="checkbox">
                                  <label class="form-check-label" for="checkbox">
                                    Add <span class="fw-bold">Rp 50.000</span> for camera rental
                                  </label>
                                </div>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="submit" class="btn btn-primary">
                            Changes
                          </button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>

              <form wire:submit.prevent>
                <tr>
                  <td>
                    <input type="checkbox" class="form-check-input checkboxone"
                      wire:click="getCartId({{ $cart->id }})" onclick="onlyOne(this)" />
                  </td>
                  <td>
                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                    <strong> {{ $key + $carts->firstItem() }} </strong>
                  </td>
                  <td> {{ $cart->tour_place->name }} </td>
                  <td>
                    <input value="{{ $cart->quantity }}" type="text" readonly="" class="form-control"
                      style="width: 50px; text-align: center;">
                  </td>
                  <td> Rp {{ $cart->tour_place->price }} </td>
                  <td class="text-center">
                    @if ($cart->price_kamera > 0)
                      Rp {{ $cart->price_kamera }}
                    @elseif ($cart->price_kamera === 0)
                      -
                    @elseif (is_null($cart->price_kamera))
                      <span class="text-warning">Not available</span>
                    @endif
                  </td>
                  <td class="text-end"> Rp {{ $cart->total_payment }} </td>
                  <td>
                    <button wire:click="editCart({{ $cart->quantity }})" class="btn btn-sm btn-primary me-1"
                      data-bs-toggle="modal" data-bs-target="#smallModal{{ $cart->id }}">
                      <i class="bx bx-edit"></i>
                    </button>
                    <button wire:click="deleteInCart({{ $cart->id }})" wire:loading.class="disabled"
                      class="btn btn-sm btn-danger">
                      <i class="bx bx-message-square-x"></i>
                    </button>
                  </td>
                </tr>
              </form>
            @endforeach

            <tr>
              <td colspan="7"></td>
              <td>
                <button wire:click="toCheckout" type="button" class="btn btn-info">Continue</button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  @else
    <div>
      <h4 class="text-light text-center"> Shopping cart is empty :) </h4>
    </div>
  @endif
  <hr class="my-5">

  @push('script')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
      function onlyOne() {
        $(".checkboxone").on("change", function() {
          $(".checkboxone").not(this).prop("checked", false);
        });
      }
    </script>
  @endpush
  <h2>{{ $cartIdCheckout }}</h2>
</div>
