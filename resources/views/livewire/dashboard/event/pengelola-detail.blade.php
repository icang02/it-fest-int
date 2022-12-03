<div wire:id="pndivC77PXVYmXgnzw8r" class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
      Wisata &amp; Event /</span>
    My Wisata
  </h4>

  <div class="row mb-4 px-md-4 px-1">
    <div class="col">
      <a class="btn btn-info" href="{{ url('/pengelola-event') }}">Kembali</a>
    </div>
  </div>

  <div class="row px-md-4 px-1">
    <div class="col">
    </div>
  </div>

  <div class="row mb-4 px-md-4 px-1 justify-content-center">

    <div class="col-md-7 mb-md-0 mb-4">
      <div class="card">
        <h5 class="card-header"> {{ $event->name }} </h5>
        <div class="card-body">
          <h6 class="text-light"><i class="bx bx-map me-1"></i> {{ $event->place }}
          </h6>
          <hr class="my-3"><img class="img-fluid w-100" src="{{ asset("storage/$event->cover") }}" alt="Image">
          <div class="mt-3"> {{ $event->description }} </div>
          <hr class="my-4">
          Periode pemesanan : <span class="fw-bold">
            {{ Carbon\Carbon::createFromFormat('Y-m-d', $event->tgl_mulai)->format('d M Y') }} —
            {{ Carbon\Carbon::createFromFormat('Y-m-d', $event->tgl_akhir)->format('d M Y') }}
          </span>


        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card">
        <div class="card-body">

          <div class="mapouter">
            <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no"
                marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?width=600&amp;height=300&amp;hl=en&amp;q={{ $event->query }}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                href="https://piratebay-proxys.com/">Piratebay</a></div>
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

          <div class="d-grid mt-2">
            <a href="{{ url($event->maps) }}" target="_blank" class="btn btn-primary"><i
                class="bx bx-paper-plane me-1"></i> Open Direction</a>
          </div>
          <hr class="my-3">
          <div class="row mb-3 text-start">
            <div class="col-md-1 col-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
              </svg>
            </div>
            <div class="col-md-11 col-9">
              <div class="fw-bold">Alamat</div> {{ $event->place }}
            </div>
          </div>
          <div class="row mb-3 text-start">
            <div class="col-md-1 col-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
              </svg>
            </div>
            <div class="col-md-11 col-9">
              <div class="fw-bold">Phone</div> {{ $event->phone }}
            </div>
          </div>
          <div class="row mb-3 text-start">
            <div class="col-md-1 col-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-ticket-perforated-fill" viewBox="0 0 16 16">
                <path
                  d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5Zm4-1v1h1v-1H4Zm1 3v-1H4v1h1Zm7 0v-1h-1v1h1Zm-1-2h1v-1h-1v1Zm-6 3H4v1h1v-1Zm7 1v-1h-1v1h1Zm-7 1H4v1h1v-1Zm7 1v-1h-1v1h1Zm-8 1v1h1v-1H4Zm7 1h1v-1h-1v1Z" />
              </svg>
            </div>
            <div class="col-md-11 col-9">
              <div class="fw-bold">Harga Tiket</div> Rp {{ number_format($event->price, 0, ',', '.') }}
            </div>
          </div>
          <div class="row mb-3 text-start">
            <div class="col-md-1 col-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                class="bi bi-hash" viewBox="0 0 16 16">
                <path
                  d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
              </svg>
            </div>
            <div class="col-md-11 col-9">
              <div class="fw-bold">Stok</div>
              @if ($event->ticket_stock != 0)
                <span> {{ $event->ticket_stock }}</span>
              @else
                <span class="text-danger">Sold out</span>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
