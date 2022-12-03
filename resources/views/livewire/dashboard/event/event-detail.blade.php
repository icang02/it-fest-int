<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Wisata &amp; Event /</span> Event </h4>
  <div class="row px-md-4 px-0">
    <div class="col-md-7 mb-md-0 mb-4">
      <div class="card">
        <h5 class="card-header"> {{ $event->name }} </h5>
        <div class="card-body">
          <h6 class="text-light"><i class="bx bx-map me-1"></i> {{ $event->place }}</h6>
          <hr class="my-3"><img class="img-fluid w-100" src="{{ asset("storage/$event->cover") }}" alt="Cover">
          <div class="mt-3"> {{ $event->description }} </div>
          <hr class="my-4">

          <form wire:submit.prevent="submitToOrder({{ $event->id }})">
            <div class="mb-3">
              <div class="form-label">Enter order quantity</div>
              @if ($event->ticket_stock > 0)
                <input wire:model="qty" min="1" type="number" class="form-control" id="quantity">
              @else
                <input type="number" class="form-control" id="quantity" readonly>
              @endif
            </div>

            <div class="mt-4">
              @if ($event->ticket_stock > 0)
                <button type="submit" class="btn btn-info me-1">
                  <i class="bx bx-right-arrow me-1"></i> Order Now
                </button>
              @else
                <button class="btn btn-info me-1" disabled>
                  <i class="bx bx-right-arrow me-1"></i> Order Now
                </button>
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
          <hr>

          <div class="mapouter">
            <div class="gmap_canvas">
              <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?width=600&amp;height=300&amp;hl=en&amp;q={{ $event->maps }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
              <a href="https://formatjson.org/">format json</a>
            </div>
            <style>
              .mapouter {
                position: relative;
                text-align: right;
                width: 100%;
                height: 300px;
              }

              .gmap_canvas {
                overflow: hidden;
                background: none !important;
                width: 100%;
                height: 300px;
              }

              .gmap_iframe {
                height: 300px !important;
              }
            </style>
          </div>

          <div class="d-grid mt-2"><a href="{{ url("https://www.google.com/maps/search/$event->maps") }}"
              target="_blank" class="btn btn-primary">
              <i class="bx bx-paper-plane me-1"></i> Open Direction</a></div>
          <hr class="my-3">
          <div class="row mb-3">
            <div class="col-md-1 col-1"><i class="bx bxs-map"></i></div>
            <div class="col-md-11 col-10">
              <div class="fw-bold">Address</div> {{ $event->place }}
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-1 col-1"><i class="bx bxs-phone"></i></div>
            <div class="col-md-11 col-10">
              <div class="fw-bold">Contact Person</div> {{ $event->phone }}
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-1 col-1"><i class="bx bxs-purchase-tag-alt"></i></div>
            <div class="col-md-11 col-10">
              <div class="fw-bold">Ticket Price</div> Rp {{ number_format($event->price, 0, ',', '.') }}
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-1"><i class="bx bxs-plane-take-off"></i></div>
            <div class="col-md-11 col-10">
              <div class="fw-bold">Stock</div>
              @if ($event->ticket_stock > 0)
                <span> {{ $event->ticket_stock }} </span>
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
