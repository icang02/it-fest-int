<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="{{ asset('sneat') }}" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>{{ $title }} | SultraSpot</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('sneat/img/favicon/logo.png') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('sneat/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('sneat/vendor/css/theme-default.css') }}"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  @auth
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/apex-charts/apex-charts.css') }}" />
  @endauth

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('sneat/vendor/css/pages/page-auth.css') }}" />
  <!-- Helpers -->
  <script src="{{ asset('sneat/vendor/js/helpers.js') }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('sneat/js/config.js') }}"></script>

  @if (env('APP_URL') == 'http://localhost')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
    <link rel="stylesheet" href="{{ asset('build/assets/app.d86a1d90.css') }}">
    <script src="{{ asset('build/assets/app.8007840a.js') }}"></script>
  @endif
</head>

<body>

  @guest
    <!-- Content -->
    @yield('main-content')
    <!-- / Content -->
  @endguest

  @auth
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">

      <div class="layout-container">
        <!-- Menu -->

        @livewire('dashboard.components.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @livewire('dashboard.components.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('main-content')
            <!-- / Content -->

            <!-- Footer -->
            @livewire('dashboard.components.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
  @endauth

  @livewireScripts
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('sneat/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('sneat/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('sneat/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

  <script src="{{ asset('sneat/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->

  @auth
    <!-- Vendors JS -->
    <script src="{{ asset('sneat/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  @endauth

  <!-- Main JS -->
  <script src="{{ asset('sneat/js/main.js') }}"></script>

  @auth
    <!-- Page JS -->
    <script src="{{ asset('sneat/js/dashboards-analytics.js') }}"></script>
  @endauth

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  @stack('script')
</body>

</html>
