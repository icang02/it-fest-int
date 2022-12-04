<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>SultraSpot | {{ $title ?? 'Landing Page' }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
    rel="stylesheet">


  <link rel="icon" type="image/x-icon" href="{{ asset('sneat/img/favicon/logo.png') }}" />
  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="{{ asset('rhea/vendors/plyr/plyr.css') }}" rel="stylesheet">
  <link href="{{ asset('rhea/css/theme.css') }}" rel="stylesheet" />

  @if (env('APP_URL') == 'http://localhost:8000')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
    <link rel="stylesheet" href="{{ asset('build/assets/app.d86a1d90.css') }}">
    <script src="{{ asset('build/assets/app.8007840a.js') }}"></script>
  @endif
</head>

<body>

  <main class="main" id="top">
    @livewire('home.components.navbar')

    @yield('main-content')

    <hr class="mt-6">
    @livewire('home.components.footer')
  </main>

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->

  @livewireScripts
  <script src="{{ asset('rhea/vendors/@popperjs/popper.min.js') }}"></script>
  <script src="{{ asset('rhea/vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('rhea/vendors/is/is.min.js') }}"></script>
  <script src="{{ asset('rhea/vendors/plyr/plyr.polyfilled.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('rhea/js/theme.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('sneat/css/translate.css') }}">
<script type="text/javascript" src="{{ asset('sneat/js/translate.js') }}"></script>
<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: "id",
        includedLanguages: 'id,en',
      },
      "google_translate_element"
    );
  }

  window.addEventListener("load", (event) => {
    const select = document.querySelector(".goog-te-combo");
    select.classList.add("form-select");
  });
</script>

  <div class="float" id="google_translate_element"></div>
  <style>
    .float {
    position: fixed;
    padding: 0%;
    width: auto;
    height: 48 px;
    bottom: 40 px;
    right: 40 px;
    color: aliceblue;
    background-color: #3984f3;
    color: rgb(7, 7, 7);
    text-align: center;
    box-shadow: 2px 2px 3px #999;
    border-top-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  </style>
   
</body>

</html>
