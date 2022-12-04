<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Invoice | SultraSpot</title>
  <style>
    @font-face {
      font-family: myfont;
      /* src: url({{ url('fonts/montserrat.ttf') }}); */
    }

    @page {
      margin: 0;
    }

    * {
      font-family: 'arial', sans-serif;
    }

    tr {
      height: 35px !important;
    }

    .bold {

      height: 60px !important;
    }
  </style>
</head>

<body style="background-color: #f8fafb">

  {{-- Start Invoice --}}
  <div class="container py-5">
    {{-- <img src="{{ asset('sneat/img/favicon/logo.png') }}" alt="Logo" class="img-fluid d-block mx-auto mb-3"
      width="100"> --}}
    <div class="text-center">
      <span class="fs-1 fw-bold lead text-center">INVOICE</span> <br>
      <span class="fs-5">SultraSpot</span>
    </div>

    <div class="body mt-5">
      <div class="px-3">
        No. order : #{{ $order->no_order }} <br>
        {{ $order->created_at->format('F j, Y - H:i:s') }}
      </div>

      <hr style="height: 2px" class="mt-4 mb-2">

      <table class="w-100">
        <tr class="fw-bold bold">
          <td class="px-3">Item</td>
          <td class="px-3 text-end">Detail</td>
        </tr>
        <tr>
          <td class="px-3">
            @if ($jenis == 'wisata')
              Nama Wisata
            @else
              Nama Event
            @endif
          </td>
          <td class="px-3 text-end">{{ $order->tour_place->name ?? $order->event->name }}</td>
        </tr>
        <tr>
          <td class="px-3">Harga Tiket</td>
          <td class="px-3 text-end">Rp
            {{ number_format($order->tour_place->price ?? $order->event->price, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="px-3">Jumlah Tiket</td>
          <td class="px-3 text-end">{{ $order->quantity }}</td>
        </tr>
        <tr class="fw-bold bold">
          <td class="px-3">Total</td>
          <td class="px-3 text-end fs-5">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="2">
            <hr style="height: 2px" class="mt-3 mb-4">
          </td>
        </tr>
        <tr>
          <td class="px-3">Contact Person</td>
          <td rowspan="2" class="px-3 text-end fs-5"><i>Terima Kasih</i></td>
        </tr>
        <tr>
          <td class="px-3">{{ $order->tour_place->telp ?? $order->event->phone }}</td>
        </tr>
      </table>
    </div>

  </div>
  {{-- End Invoice --}}


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
