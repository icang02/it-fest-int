<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
      Wisata &amp; Event /</span>
    @if (auth()->user()->role_id == 2)
      Wisata
    @else
      My Wisata
    @endif
  </h4>

  @if (auth()->user()->role_id == 3)
    <div class="row mb-4 px-md-4 px-1">
      <div class="col">
        @if ($wisata !== null)
          <a class="btn btn-info" href="{{ route('wisata.edit', $wisata->id) }}" role="button">Edit Data</a>
        @else
          <a class="btn btn-primary" href="{{ route('wisata.add') }}" role="button">Add Data</a>
        @endif
      </div>
    </div>

    <div class="row px-md-4 px-1">
      <div class="col">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
    </div>
  @endif

  <div class="row mb-4 px-md-4 px-1 justify-content-center">

    @if (Auth::user()->role_id == 2)
      @foreach ($allWisata as $wisata)
        <div class="col-md-6 mb-2">
          <a class="card mb-3 cursor-pointer shadow text-secondary" href="{{ url('wisata/' . $wisata->id) }}">
            <div class="row g-0">
              <div class="col-md-4 bg-wisata" style="background-image: url({{ $wisata->image }});">
              </div>

              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"> {{ $wisata->name }} </h5>
                  <p class="card-text"><i class="bx bxs-map"></i> {{ $wisata->address }}</p>
                  <p class="card-text"><small class="text-muted"> {{ $wisata->city }} </small></p>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    @elseif (Auth::user()->role_id == 3)
      @if ($wisata !== null)
        <div class="col-md-7 mb-md-0 mb-4">
          <div class="card">
            <h5 class="card-header"> {{ $wisata->name }} </h5>
            <div class="card-body">
              <h6 class="text-light"><i class="bx bx-map me-1"></i> {{ $wisata->address }}
              </h6>
              <hr class="my-3"><img class="img-fluid" src="{{ $wisata->image }}" alt="Image">
              <div class="mt-3"> {{ $wisata->description }} </div>
              <hr class="my-4">
              Camera rental is : <span class="fw-bold"> {{ $wisata->rental == 1 ? 'Available' : 'Not available' }}
              </span>

              @if (auth()->user()->role_id == 2)
                <form wire:submit.prevent="submitToOrder(41)">
                  <div class="mb-3">
                    <div class="form-label">Enter order quantity</div>
                    <input wire:model="qty" min="1" type="number" class="form-control" id="quantity">
                  </div>

                  <div class="form-check">
                    <input wire:model="chkboxSewaKamera" class="form-check-input" type="checkbox" id="rental">
                    <label class="form-check-label" for="rental"> Add <span class="fw-bold">
                        Rp 50.000</span> for camera rental
                    </label>
                  </div>

                  <div class="mt-4">
                    <button type="submit" class="btn btn-info me-1">
                      <i class="bx bx-right-arrow me-1"></i> Order Now
                    </button>

                  </div>
                </form>
              @endif

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
                  <div class="fw-bold">Ticket Price</div> Rp {{ number_format($wisata->price, 0, '.', '.') }}
                </div>
              </div>
              <div class="row">
                <div class="col-md-1 col-1"><i class="bx bxs-plane-take-off"></i></div>
                <div class="col-md-11 col-11">
                  <div class="fw-bold">Stock</div>
                  <span> {{ $wisata->ticket_stock }} </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      @else
        <div>
          <h4 class="text-light text-center"> No travel data yet 💩 </h4>
        </div>
      @endif
    @endif

  </div>
</div>
<hr class="my-5">
</div>
