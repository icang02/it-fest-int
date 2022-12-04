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
</head>

<body>

  <div class="card">
    <div class="card-body mx-lg-4 mx-0">
      <div class="container">
        <p class="my-5 text-center" style="font-size: 30px;">Thank for your purchase</p>
        <div class="row">
          <ul class="list-unstyled">
            <li class="text-black">{{ $order->user->name }}</li>
            <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $order->no_order }}</li>
            <li class="text-black mt-1">
              {{ $order->created_at->format('F j Y - H:i:s') }}
            </li>
          </ul>
          <hr>
          <div class="col-xl-4">
            @if ($jenis == 'wisata')
              <p>Destination</p>
            @else
              <p>Event Name</p>
            @endif
          </div>
          <div class="col-8">
            @if ($jenis == 'wisata')
              <p class="float-end">{{ $order->tour_place->name }}</p>
            @else
              <p class="float-end">{{ $order->event->name }}</p>
            @endif
          </div>
          <hr>
        </div>
        <div class="row">
          <div class="col-4">
            <p>Ticket Price</p>
          </div>
          <div class="col-xl-8">
            @if ($jenis == 'wisata')
              <p class="float-end">Rp {{ number_format($order->tour_place->price, 0, ',', '.') }}</p>
            @else
              <p class="float-end">Rp {{ number_format($order->event->price, 0, ',', '.') }}</p>
            @endif
          </div>
          <hr>
        </div>
        <div class="row">
          <div class="col-xl-4">
            <p>Qty</p>
          </div>
          <div class="col-xl-8">
            <p class="float-end">{{ $order->quantity }}</p>
          </div>
          <hr style="border: 2px solid black;">
        </div>
        <div class="row text-black">

          <div class="col-xl-12">
            <p class="float-end fw-bold">Total: Rp {{ number_format($order->total_payment, 0, ',', '.') }}
            </p>
          </div>
          <hr style="border: 2px solid black;">
        </div>
        <div class="text-center" style="margin-top: 90px;">
          <a><u class="text-info">SultraSpot</u></a>
          <p>The other Spot of Sulawesi Tenggara </p>
        </div>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
