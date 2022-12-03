<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction / Order / </span> Detail </h4>
  <div class="row px-md-4 px-1">
    <div class="col-md-7 mb-md-0 mb-4">
      <div class="card">
        <h5 class="card-header" wire:click="clickMe">No. Order : {{ $order->no_order }}</h5>
        <div class="card-body"><img src="{{ $order->tour_place->image }}" alt="Image" class="img-fluid">
          <div class="row mt-4">
            <div class="col-md-6 col-6">
              <div>
                <h6 class="fw-bold">Customer name</h6>
                <p>{{ $order->user->name }}</p>
              </div>
              <div>
                <h6 class="fw-bold">Ticket price</h6>
                <p>Rp {{ number_format($order->tour_place->price, 0, ',', '.') }}</p>
              </div>
              <div>
                <h6 class="fw-bold">Total</h6>
                <p>Rp {{ number_format($order->total_payment, 0, ',', '.') }}</p>
              </div>
            </div>
            <div class="col-md-6 col-6">
              <div>
                <h6 class="fw-bold">Tourist destination</h6>
                <p>{{ $order->tour_place->name }}</p>
              </div>
              <div>
                <h6 class="fw-bold">Quantity</h6>
                <p>{{ $order->quantity }}</p>
              </div>
              <div>
                <h6 class="fw-bold">Order date</h6>
                <p>{{ $order->created_at }}</p>
              </div>
            </div>
          </div>
          <hr class="mb-4">

          @if ($order->status == 'selesai' && auth()->user()->role_id == 2)
            <button class="btn btn-info">Print ticket</button>
          @endif

          @if ($order->image_tf == null && $order->status == 'pending' && auth()->user()->role_id == 2)
            <form wire:submit.prevent="uploadImage">
              <h6 class="fw-bold">Evidence of transfer</h6>
              <div class="input-group mt-3">
                <input wire:model="image" type="file" class="form-control @error('image') is-invalid @enderror"
                  accept="image/jpg, image/jpeg, image/png">
                <button class="btn btn-primary" wire:loading.class="disabled" type="submit"> Send </button>
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </form>
          @else
            @if ($order->image_tf != null)
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bukti-tf">
                See Evidence of transfer
              </button>
            @endif

            {{-- Modal show bukti tf --}}
            <div wire:ignore.self class="modal fade" id="bukti-tf" tabindex="-1" aria-labelledby="bukti-tf"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evidence of transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <img src="{{ asset("storage/$order->image_tf") }}" alt="bukti transfer" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          @endif


        </div>
      </div>
    </div>
  </div>

  <hr class="my-5">

  {{-- Modal Bukti Transfer --}}
  <div class="modal fade" id="basicModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-basic" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2"></h5><button type="button" class="btn-close"
            data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-0"><img src="nota.jpg" class="img-fluid"></div>
          </div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            CLose </button></div>
      </div>
    </div>
  </div>
</div>
