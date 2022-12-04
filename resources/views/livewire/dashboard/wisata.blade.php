<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
      Wisata &amp; Event /</span> My Wisata
  </h4>

  <div class="row mb-4 px-md-4 px-0">
    <div class="col">
      @if ($wisata !== null)
        <a class="btn btn-info" href="{{ route('wisata.edit', $wisata->id) }}" role="button">Edit Data</a>
      @else
        <a class="btn btn-primary" href="{{ route('wisata.add') }}" role="button">Tambah Data</a>
      @endif
    </div>
  </div>

  <div class="row px-md-4 px-0">
    <div class="col">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
  </div>

  <div class="row mb-4 px-md-4 px-0 justify-content-center">

    @if ($wisata !== null)
      <div class="col-md-7 mb-md-0 mb-4">
        <div class="card">
          <h5 class="card-header"> {{ $wisata->name }} </h5>
          <div class="card-body">
            <h6 class="text-light"><i class="bx bx-map me-1"></i> {{ $wisata->address }}
            </h6>
            <hr class="my-3">
            <img class="img-fluid" src="{{ asset("storage/$wisata->image") }}" alt="Image">
            <div class="mt-3" style="text-align: justify"> {{ $wisata->description }} </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">
        <div class="card">
          <div class="card-body">

            <div class="mapouter">
              <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no"
                  marginheight="0" marginwidth="0"
                  src="https://maps.google.com/maps?width=600&amp;height=300&amp;hl=en&amp;q={{ $wisata->query }}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
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

            <div class="d-grid mt-2"><a href="{{ $wisata->maps }}" target="_blank" class="btn btn-primary"><i
                  class="bx bx-paper-plane me-1"></i> Open Direction</a></div>
            <hr class="my-3">
            <div class="row mb-3">
              <div class="col-md-1 col-1"><i class="bx bxs-map"></i></div>
              <div class="col-md-11 col-9">
                <div class="fw-bold">Alamat</div> {{ $wisata->address }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-1 col-1"><i class="bx bxs-phone"></i></div>
              <div class="col-md-11 col-9">
                <div class="fw-bold">Telp</div> {{ $wisata->telp }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-1 col-1"><i class="bx bxs-purchase-tag-alt"></i></div>
              <div class="col-md-11 col-9">
                <div class="fw-bold">Harga Tiket</div> Rp {{ number_format($wisata->price, 0, '.', '.') }}
              </div>
            </div>
            <div class="row">
              <div class="col-md-1 col-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                  class="bi bi-hash" viewBox="0 0 16 16">
                  <path
                    d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
                </svg>
              </div>
              <div class="col-md-11 col-9">
                <div class="fw-bold">Stok Tiket</div>
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

  </div>
</div>
<hr class="my-5">
</div>
