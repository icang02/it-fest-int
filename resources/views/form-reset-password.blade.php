@extends('layouts.dashboard')

@section('main-content')
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
            <h4 class="mb-2">Reset Your Password 🔒</h4>
            <p class="mb-4">Please write a new password in your notes so you don't forget it</p>

            <form action="{{ url('reset-password') }}" method="POST">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ old('email') }}" type="text" name="email"
                  class="form-control @error('email') is-invalid @enderror" id="email"
                  placeholder="Enter your email" />
              </div>

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input name="password" type="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" autocomplete="off" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @error('password')
                    <div class="invalid-feedback"> {{ $message }} </div>
                  @enderror
                </div>
              </div>

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Confirm New Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input name="password_confirmation" type="password" id="password" class="form-control"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" autocomplete="off" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <button type="submit" class="btn btn-primary d-grid w-100 color-primary-bg color-primary-outline">
                Reset Password
              </button>
            </form>

          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>
@endsection
