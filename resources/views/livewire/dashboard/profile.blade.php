<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Profile</h4>

  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
          <a class="nav-link active color-primary-bg color-primary-outline" href="#"><i class="bx bx-user me-1"></i>
            Account</a>
        </li>
      </ul>

      {{-- Message Success --}}
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form wire:submit.prevent="updateUser({{ $userId }})">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start   align-items-sm-center gap-4">
              @if ($imgProfil)
                <img src="{{ $imgProfil->temporaryUrl() }}" alt="user-avatar" class="d-block rounded" height="100"
                  width="100" id="uploadedAvatar" />
              @elseif ($imgAvatars == null)
                <img src="{{ asset('sneat/img/avatars/profil.png') }}" alt="user-avatar" class="d-block rounded"
                  height="100" width="100" id="uploadedAvatar" />
              @else
                <img src="{{ "storage/$imgAvatars" }}" alt="user-avatar" class="d-block rounded" height="100"
                  width="100" id="uploadedAvatar" />
              @endif

              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4 color-primary-bg color-primary-outline"
                  wire:loading.class='disabled' tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input wire:model="imgProfil" onchange="previewImage()" type="file" id="upload"
                    class="account-file-input sampul" hidden accept="image/png, image/jpeg" />
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4"
                  wire:click='resetAvatars()' wire:loading.class='disabled'>
                  <i class="bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>
                <p class="text-muted mb-0">
                  Allowed JPG, or PNG. Max size of 2MB. Please upload a picture with a ratio of 1:1.
                </p>
                @error('imgProfil')
                  <div class="text-danger"> {{ $message }} </div>
                @enderror
              </div>
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input wire:model="name" class="form-control @error('name') is-invalid @enderror" type="text"
                  id="name" value="{{ $name }}" />
                @error('name')
                  <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="username" class="form-label">User name</label>
                <input class="form-control" type="text" id="username" value="{{ $username }}" readonly />
              </div>

              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input wire:model="email" class="form-control @error('email') is-invalid @enderror" type="text"
                  id="email" value="{{ $email }}" />
                @error('email')
                  <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="user_type" class="form-label">User Type</label>
                <input type="text" class="form-control" id="user_type" value="{{ str()->title($userType) }}"
                  readonly />
              </div>

              @can('pengelola')
                <div class="mb-3 mb-6 col-md-6">
                  <label for="noRek" class="form-label">No. Rekening Bank</label>
                  <input wire:model="noRek" type="text" class="form-control @error('noRek') is-invalid @enderror"
                    id="noRek" value="{{ $noRek }}" placeholder="No. rekening (Nama Bank)" />
                  @error('noRek')
                    <div class="invalid-feedback"> {{ $message }} </div>
                  @enderror
                </div>
              @endcan
            </div>

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2 color-primary-bg color-primary-outline"
                wire:loading.class='disabled'>Save
                changes</button>
              <button wire:click="resetForm" type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </div>
          <!-- /Account -->
        </div>
      </form>

      @if (!Gate::check('admin'))
        <div class="card">
          <h5 class="card-header">Delete Account</h5>
          <div class="card-body">
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
              </div>
            </div>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="@mdo">
              Deactivate Account
            </button>
          </div>
        </div>
      @endif

    </div>
  </div>

  {{-- Modal Start --}}
  <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form wire:submit.prevent="dactiveAccount({{ Auth::user()->id }})">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <div class="mb-2">
                <span class="text-muted">Enter your username : </span>
                {{ Auth::user()->username }}</label>
              </div>
              <input wire:model="usernameDelete" type="text"
                class="form-control @error('usernameDelete') is-invalid @enderror" id="username-delete"
                autocomplete="off">
              @error('usernameDelete')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="form-check">
              <input wire:model="checkboxDeactive"
                class="form-check-input @error('checkboxDeactive') is-invalid @enderror" type="checkbox"
                id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                I confirm my account deactivation
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- Modal End --}}

  @push('script')
    <script>
      function previewImage() {
        const image = document.querySelector(".sampul");
        const imgPreview = document.querySelector(".img-preview");

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
          imgPreview.src = oFREvent.target.result;
        };
      }
    </script>
  @endpush
</div>
