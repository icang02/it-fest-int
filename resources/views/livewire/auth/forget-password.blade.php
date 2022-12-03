<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
      <!-- Forgot Password -->
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
          <h4 class="mb-2">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

          <form wire:submit.prevent='sendLink()'>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input wire:model='email' type="text" name="email"
                class="form-control @error('email') is-invalid @enderror" id="email"
                placeholder="Enter your email" />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100 color-primary-bg color-primary-outline">Send
              Reset Link</button>
          </form>

          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center color-primary">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
