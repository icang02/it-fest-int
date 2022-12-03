<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Daftar User / {{ str()->title($role->name) }} / </span>
    Edit </h4>
  <div class="row">
    <div class="col-md-7">
      <div class="card mb-4">
        <h5 class="card-header">Data Profil</h5>
        <div class="card-body">

          <form wire:submit.prevent="UpdateUser({{ $user->id }})">
            <div class="mb-3">
              <label for="name" class="form-label"> Full Name </label>
              <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror"
                id="name" placeholder="Sultraspot">
              @error('name')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label"> E-Mail </label>
              <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror"
                id="email" placeholder="sultraspot@gmail.com">
              @error('email')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="role_id" class="form-label"> User Type </label>
              <select class="form-select @error('roleId') is-invalid @enderror" id="role_id" wire:model="roleId">
                @foreach ($roles as $role)
                  <option {{ $role->name !== $user->role->name ?: 'selected' }} value="{{ $role->id }}">
                    {{ str()->title($role->name) }}
                  </option>
                @endforeach
              </select>
              @error('roleId')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary"> Save </button>
              <button wire:click="formReset({{ $user->id }})" type="reset" class="btn btn-danger"> Reset </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <hr class="my-5">
</div>
