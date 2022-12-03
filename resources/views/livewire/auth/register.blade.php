<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{ route('home') }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="{{ asset('sneat/img/favicon/logo.png') }}" alt="logo" width="32">
              </span>
              <span class="app-brand-text demo text-body fw-bolder">SultraSpot</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Adventure starts here 🚀</h4>
          <p class="mb-4">Make your app management easy and fun!</p>

          <form class="mb-3" wire:submit.prevent="registerSend">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror"
                id="name" placeholder="Enter your name" />
              @error('name')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input wire:model="username" type="text" class="form-control @error('username') is-invalid @enderror"
                id="username" placeholder="Enter your username" />
              @error('username')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror"
                id="email" placeholder="Enter your email" />
              @error('email')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="role_id" class="form-label"> User Type </label>
              <select wire:model="roleId" class="form-select @error('roleId') is-invalid @enderror" id="role_id">
                <option> Select.. </option>
                @foreach ($roles as $role)
                  <option value="{{ $role->id }}">
                    {{ Str::title($role->name) }}
                  </option>
                @endforeach
              </select>
              @error('roleId')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input wire:model="password" type="password" id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                @error('password')
                  <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
              </div>
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input wire:model="password_confirmation" type="password" id="password_confirmation"
                  class="form-control"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input wire:model="agree" class="form-check-input @error('agree') is-invalid @enderror" type="checkbox"
                  id="terms-conditions" name="terms" />
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);" class="color-primary">privacy policy & terms</a>
                </label>
                @error('agree')
                  <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100 color-primary-bg color-primary-outline">Sign
              up
            </button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">
              <span class="color-primary">Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
