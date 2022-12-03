<div wire:id="59thO3yAGJIZ50s19XyG" class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Wisata & Event / My Wisata /</span> Add </h4>

  <div class="row">
    <div class="col-md-12">

      <form wire:submit.prevent="storeData">
        <div class="card mb-4">
          <h5 class="card-header">Form Add Data</h5>

          <hr class="my-0">
          <div class="card-body">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Place Name</label>
                <input wire:model="name" class="form-control @error('name') is-invalid @enderror" type="text"
                  id="name">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="city" class="form-label">City</label>
                <input wire:model='city' class="form-control @error('city') is-invalid @enderror" type="text"
                  id="city">
                @error('city')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input wire:model="address" class="form-control @error('address') is-invalid @enderror" type="text"
                  id="address">
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input wire:model='telp' type="text" class="form-control @error('telp') is-invalid @enderror"
                  id="phone">
                @error('telp')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                  rows="3"></textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-4">
                <label for="price" class="form-label">Ticket Price</label>
                <input wire:model='price' type="number" class="form-control @error('price') is-invalid @enderror"
                  id="price">
                @error('price')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-4">
                <label for="ticket_stock" class="form-label">Stock</label>
                <input wire:model='ticket_stock' type="number"
                  class="form-control @error('ticket_stock') is-invalid @enderror" id="ticket_stock">
                @error('ticket_stock')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-4">
                <label for="rental" class="form-label">Camera Rental</label>
                <select wire:model='rental' class="form-select @error('rental') is-invalid @enderror">
                  <option selected>Select menu</option>
                  <option value="1">Available</option>
                  <option value="0">Not available</option>
                </select>
                @error('rental')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="image" class="form-label">Upload Photos Place</label>
                <input wire:model='image' type="file" class="form-control @error('image') is-invalid @enderror"
                  id="image">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="maps" class="form-label">Maps Link</label>
                <input wire:model='maps' type="url" class="form-control @error('maps') is-invalid @enderror"
                  id="maps" placeholder="https://goo.gl/maps">
                @error('maps')
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
