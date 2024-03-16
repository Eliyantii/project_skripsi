<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karunia Motor</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/gambar.js"></script>
    <script src="/js/grafik.js"></script>
    <script src="/js/penawaran.js"></script>
    <script src="/js/daftar.js"></script>
    <script src="/js/cart.js"></script>
    <script src="/js/checkout.js"></script>

    @yield('js')
  </head>
  <body class="bg-light">

    @include('home.components.navbar')

    <div class="container-product">
      @yield('hero-image')
      @yield('content')
    </div>
    
    @include('home.components.modalPesan')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>