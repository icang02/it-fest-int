<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat') }}"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>{{ $title }} | SultraSpot</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('sneat') }}/img/favicon/logo.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('sneat') }}/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('sneat') }}/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('sneat') }}/vendor/css/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('sneat') }}/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('sneat') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('sneat') }}/vendor/css/pages/page-misc.css" />
  <!-- Helpers -->
  <script src="{{ asset('sneat') }}/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('sneat') }}/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <!--Under Maintenance -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">Pesanan berhasil dibuat!</h2>
      <p class="mb-4 mx-2">Terima kasih telah menggunakan aplikasi kami — silahkan selesaikan pembayaran Anda.</p>
      <a href="{{ url('/semua-order') }}" class="btn btn-primary">Lihat pesanan saya</a>
      <div class="mt-4">
        <img src="{{ asset('sneat') }}/img/illustrations/girl-doing-yoga-light.png" alt="girl-doing-yoga-light"
          width="500" class="img-fluid" data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
          data-app-light-img="illustrations/girl-doing-yoga-light.png" />
      </div>
    </div>
  </div>
  <!-- /Under Maintenance -->

  <!-- / Content -->

  <!-- Core JS -->
  <script src="{{ asset('sneat') }}/vendor/libs/jquery/jquery.js"></script>
  <script src="{{ asset('sneat') }}/vendor/libs/popper/popper.js"></script>
  <script src="{{ asset('sneat') }}/vendor/js/bootstrap.js"></script>
  <script src="{{ asset('sneat') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="{{ asset('sneat') }}/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="{{ asset('sneat') }}/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
