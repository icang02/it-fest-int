<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Account /</span>
    {{ str()->title($role->name) }}</h4>

  {{-- Message Successs --}}
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card">
    <h5 class="card-header">Table User Account</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <caption class="ms-4">
          List of {{ str()->title($role->name) }}
        </caption>
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Profil Image</th>
            <th>E-Mail</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $key => $user)
            <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong> {{ $key + $users->firstItem() }}
                </strong></td>
              <td> {{ $user->name }} </td>
              <td>
                <li data-bs-toggle="tooltip" data-bs-placement="top" class="avatar avatar-xs pull-up list-unstyled"
                  data-bs-original-title="{{ $user->name }}">
                  <img src="{{ asset('sneat/img/avatars/profil.png') }}" alt="Avatar" class="rounded-circle">
                </li>
              </td>
              <td> {{ $user->email }} </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url("$role->name/$user->username/edit") }}"><i
                        class="bx bx-edit-alt me-1"></i> Edit</a>
                    @if (auth()->user()->role_id !== $user->role_id)
                      <button class="dropdown-item" wire:click="deleteConfirm({{ $user->id }})">
                        <i class="bx bx-trash me-1"></i>
                        Delete
                      </button>
                    @endif
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="px-4 py-1">
        {{ $users->onEachSide(0.5)->withQueryString()->links() }}
      </div>
    </div>
  </div>

  <hr class="my-5">
</div>
