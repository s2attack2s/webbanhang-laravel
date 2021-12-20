<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="/css/Home/Header.css">
  <link rel="stylesheet" href="/css/Home/Slider.css">
  <link rel="stylesheet" href="/css/Home/FreeShip.css">
  <link rel="stylesheet" href="/css/Home/Footer.css">
  <link rel="stylesheet" href="/css/Home/app.css">
  @yield('css')
</head>

<body class="antialiased">

  <div class="loading-index">
    <div class="double-loading">
      <div class="c1"></div>
      <div class="c2"></div>
    </div>
  </div>
  <div class="alert alert-success alert-dismissible fade show alert-cart-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Thêm sản phẩm thành công</strong>
  </div>
  @include('sweetalert::alert')
  @include('Home.Header')
  @yield('body')
  @include('Home.FreeShip')
  @include('Home.Footer')

  <div class="scrollTop">
    <button class="btn btn-primary"><i class="bi bi-arrow-up-square-fill"></i></button>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="/js/Home/Header.js" type="text/javascript"></script>
  <script src="/js/Home/Slider.js" type="text/javascript"></script>
  <script src="/js/Home/FreeShip.js" type="text/javascript"></script>
  <script src="/js/Home/Cart.js" type="text/javascript"></script>
  @yield('scripts')
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>

</html>