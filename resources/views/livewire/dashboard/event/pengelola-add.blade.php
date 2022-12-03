<div wire:id="59thO3yAGJIZ50s19XyG" class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Wisata & Event / My Wisata /</span> Tambah </h4>

  <div class="row">
    <div class="col-md-12">

      <form wire:submit.prevent="storeData">
        <div class="card mb-4">
          <h5 class="card-header">Form Tambah Data</h5>

          <hr class="my-0">
          <div class="card-body">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Nama Event</label>
                <input wire:model="name" class="form-control @error('name') is-invalid @enderror" type="text"
                  id="name">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">No. Hp</label>
                <input wire:model='phone' class="form-control @error('phone') is-invalid @enderror" type="text"
                  id="phone">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-12">
                <label for="place" class="form-label">Alamat</label>
                <input wire:model="place" class="form-control @error('place') is-invalid @enderror" type="text"
                  id="place">
                @error('place')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Event</label>
                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                  rows="3"></textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-4">
                <label for="cover" class="form-label">Upload Cover Event</label>
                <input wire:model='cover' type="file" class="form-control @error('cover') is-invalid @enderror"
                  id="cover">

                @if ($cover)
                  <img src="{{ $cover->temporaryUrl() }}" alt="Cover" class="d-block mt-2 mb-1 img-thumbnail"
                    width="200" />
                @endif

                @error('cover')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-4">
                <label for="price" class="form-label">Harga Tiket</label>
                <input wire:model='price' type="number" class="form-control @error('price') is-invalid @enderror"
                  id="price">
                @error('price')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-4">
                <label for="ticket_stock" class="form-label">Stok</label>
                <input wire:model='ticket_stock' type="number"
                  class="form-control @error('ticket_stock') is-invalid @enderror" id="ticket_stock">
                @error('ticket_stock')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="maps" class="form-label">Link Maps</label>
                <input wire:model='maps' type="url" class="form-control @error('maps') is-invalid @enderror"
                  id="maps" placeholder="https://goo.gl/maps">
                @error('maps')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="query" class="form-label">Query Maps</label>
                <input wire:model='query' type="text" class="form-control @error('query') is-invalid @enderror"
                  id="query" placeholder="Kata kunci pencarian di maps">
                @error('query')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="tgl_mulai" class="form-label">Awal Pemesanan</label>
                <input wire:model='tgl_mulai' type="date"
                  class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai">
                @error('tgl_mulai')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3 col-md-6">
                <label for="tgl_akhir" class="form-label">Akhir Pemesanan</label>
                <input wire:model='tgl_akhir' type="date"
                  class="form-control @error('tgl_akhir') is-invalid @enderror" id="tgl_akhir">
                @error('tgl_akhir')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2 color-primary-bg color-primary-outline"
                wire:loading.class="disabled">Save
                changes</button>
              <button wire:click="resetForm" type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <hr class="my-5">
</div>
