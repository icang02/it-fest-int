<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Wisata &amp; Event /</span> Wisata </h4>
  <div class="row px-md-4 px-1">
    <div class="col-md-7 mb-md-0 mb-4">
      <div class="card">
        <h5 class="card-header"> {{ $wisata->name }} </h5>
        <div class="card-body">
          <h6 class="text-light"><i class="bx bx-map me-1"></i> {{ $wisata->address }}</h6>
          <hr class="my-3"><img class="img-fluid" src="{{ $wisata->image }}" alt="Image">
          <div class="mt-3"> {{ $wisata->description }} </div>
          <hr class="my-4">

          <form wire:submit.prevent="submitToOrder({{ $wisata->id }})">
            <div class="mb-3">
              <div class="form-label">Enter order quantity</div>
              @if ($wisata->ticket_stock > 0)
                <input wire:model="qty" min="1" type="number" class="form-control" id="quantity">
              @else
                <input type="number" class="form-control" id="quantity" readonly>
              @endif
            </div>

            @if ($wisata->rental)
              <div class="form-check">
                <input wire:model="chkboxSewaKamera" class="form-check-input" type="checkbox" id="rental">
                <label class="form-check-label" for="rental"> Add <span class="fw-bold">
                    Rp 50.000</span> for camera rental
                </label>
              </div>
            @endif

            <div class="mt-4">
              @if ($wisata->ticket_stock > 0)
                <button type="submit" class="btn btn-info me-1">
                  <i class="bx bx-right-arrow me-1"></i> Order Now
                </button>
                {{-- <div class="btn btn-warning" wire:click="addToCart({{ $wisata->id }})" wire:loading.class="disabled">
                  <i class="bx bxs-cart-add me-1"></i> Save
                </div> --}}
              @else
                <button class="btn btn-info me-1" disabled>
                  <i class="bx bx-right-arrow me-1"></i> Order Now
                </button>
                {{-- <div class="btn btn-warning" disabled>
                  <i class="bx bxs-cart-add me-1"></i> Save
                </div> --}}
              @endif
            </div>
          </form>

        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h5><i class="bx bxs-map-pin me-1"></i> MAPS</h5>
          <hr><img class="img-fluid" src="{{ asset('sneat/img/maps/maps.png') }}" alt="Image">
          <div class="d-grid mt-2"><a href="{{ $wisata->maps }}" target="_blank" class="btn btn-primary"><i
                class="bx bx-paper-plane me-1"></i> Open Direction</a></div>
          <hr class="my-3">
          <div class="row mb-3">
            <div class="col-md-1 col-1"><i class="bx bxs-map"></i></div>
            <div class="col-md-11 col-11">
              <div class="fw-bold">Address</div> {{ $wisata->address }}
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-1 col-1"><i class="bx bxs-phone"></i></div>
            <div class="col-md-11 col-11">
              <div class="fw-bold">Phone</div> {{ $wisata->telp }}
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-1 col-1"><i class="bx bxs-purchase-tag-alt"></i></div>
            <div class="col-md-11 col-11">
              <div class="fw-bold">Ticket Price</div> Rp {{ number_format($wisata->price, 0, ',', '.') }}
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-1"><i class="bx bxs-plane-take-off"></i></div>
            <div class="col-md-11 col-11">
              <div class="fw-bold">Stock</div>
              @if ($wisata->ticket_stock > 0)
                <span> {{ $wisata->ticket_stock }} </span>
              @else
                <span class="text-danger"> Tickets sold out </span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr class="my-5">
</div>
