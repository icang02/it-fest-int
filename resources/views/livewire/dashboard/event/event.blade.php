<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
      Wisata &amp; Event /</span>
    Event
  </h4>

  <div class="row mb-4 px-md-4 px-1 justify-content-center">

    @foreach ($events as $event)
      <div class="col-md-12 mb-2">
        <a class="card mb-3 cursor-pointer shadow text-secondary" href="{{ url("event/$event->id") }}">
          <div class="row g-0">
            <div class="col-md-2 bg-wisata" style="background-image: url({{ asset("storage/$event->cover") }});">
            </div>

            <div class="col-md-7">
              <div class="card-body">
                <h5 class="card-title mb-4"> {{ $event->name }} </h5>
                <p class="card-text">
                  <i class="bx bxs-calendar me-1"></i> {{ $event->tgl_mulai }} — {{ $event->tgl_akhir }}
                </p>
                <p class="card-text">
                  <i class="bx bxs-map me-1"></i> {{ $event->place }}
                </p>
              </div>
            </div>

            <div class="col-md-3 my-auto fw-bold">
              <i class='bx bx-calendar me-1 fs-3'></i>
              <span class="color-primary">
                Stock Ticket : {{ $event->ticket_stock }}
              </span>
            </div>
          </div>
        </a>
      </div>
    @endforeach

  </div>
</div>
