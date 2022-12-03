<section class="py-0">
  <style>
    .form-control {
      color: rgba(0, 0, 0, .7);
    }

    ::placeholder {
      color: rgba(0, 0, 0, .7);

    }

    .form-control:focus {
      color: rgba(0, 0, 0, .7);
    }
  </style>

  <div
    style="background-image: url({{ asset('sneat/img/kategori/bg-profile.jpg') }}); background-size: cover; background-position: center; height: 450px;">
  </div>

  <div class="container position-relative">
    <div class="row align-items-center min-vh-25">
      <div class="col-md-12 col-lg-12 text-center text-md-start" style="margin-top: -65px;">

        <div class="card border shadow-lg p-lg-4 p-3" style="border-radius: 30px;">
          <div class="card-body">
            <h2 class="fw-bold text-center">My Profile <span class="text-primary">SultraSpot</span></h2>
            <hr style="height: 2px; width: 170px; border-radius: 5px;" class="mt-3 mb-5 mx-auto bg-primary">

            <div class="row gy-lg-4 gy-2 justify-content-center">

              <div class="col-12">
                <hr>
              </div>

              <div class="col-12">
                {{-- Message Success --}}
                @if (session()->has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form wire:submit.prevent="updateUser({{ $userId }})">
                  <div class="card mb-4">
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start   align-items-sm-center gap-4">
                        @if ($imgProfil)
                          <img src="{{ $imgProfil->temporaryUrl() }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar" />
                        @elseif ($imgAvatars == null)
                          <img src="{{ asset('sneat/img/avatars/profil.png') }}" alt="user-avatar"
                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        @else
                          <img src="{{ "storage/$imgAvatars" }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar" />
                        @endif

                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4 color-primary-bg color-primary-outline"
                            wire:loading.class='disabled' tabindex="0">
                            <span class="d-none d-sm-block">Unggah profil</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input wire:model="imgProfil" onchange="previewImage()" type="file" id="upload"
                              class="account-file-input sampul" hidden accept="image/png, image/jpeg" />
                          </label>
                          <button onclick="window.location.href='/my-profile'" type="button"
                            class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>
                          <p class="mb-0" style="color: rgba(0, 0, 0, .4)">
                            Upload format JPG atau PNG dengan rasio 1:1. Maksimal 2MB.
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
                          <label for="name" class="form-label">Nama Lengkap</label>
                          <input wire:model="name" class="form-control @error('name') is-invalid @enderror"
                            type="text" id="name" value="{{ $name }}" />
                          @error('name')
                            <div class="invalid-feedback"> {{ $message }} </div>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="username" class="form-label">Username</label>
                          <input class="form-control" type="text" id="username" value="{{ $username }}"
                            readonly />
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="email" class="form-label">E-mail</label>
                          <input wire:model="email" class="form-control @error('email') is-invalid @enderror"
                            type="text" id="email" value="{{ $email }}" />
                          @error('email')
                            <div class="invalid-feedback"> {{ $message }} </div>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="user_type" class="form-label">Tipe User</label>
                          <input type="text" class="form-control" id="user_type"
                            value="{{ str()->title($userType) }}" readonly />
                        </div>

                        @can('pengelola')
                          <div class="mb-3 mb-6 col-md-6">
                            <label for="noRek" class="form-label">No. Rekening Bank</label>
                            <input wire:model="noRek" type="text"
                              class="form-control @error('noRek') is-invalid @enderror" id="noRek"
                              value="{{ $noRek }}" placeholder="No. rekening (Nama Bank)" />
                            @error('noRek')
                              <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                          </div>
                        @endcan
                      </div>

                      <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2 color-primary-bg color-primary-outline"
                          wire:loading.class='disabled'>Simpan</button>
                        <button wire:click="resetForm" type="reset"
                          class="btn btn-outline-secondary">Cancel</button>
                      </div>
                    </div>
                    <!-- /Account -->
                  </div>
                </form>

                <hr>

                @if (!Gate::check('admin'))
                  <div class="card">
                    <h5 class="card-header">Hapus Akun</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Apakah Anda yakin ingin menghapus akun?</h6>
                          <p class="mb-0">Setelah dihapus, akun Anda tidak dapat dikembalikan.
                          </p>
                        </div>
                      </div>
                      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal"
                        data-bs-whatever="@mdo">
                        Lanjutkan
                      </button>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Start --}}
  <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form wire:submit.prevent="dactiveAccount({{ Auth::user()->id }})">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Akun User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <div class="mb-2">
                Masukan username Anda :
                <span class="fw-bold">{{ Auth::user()->username }}</span>
                </label>
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
                Saya menyetujui penghapusan akun.
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- Modal End --}}
</section>
