<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    {!! SEO::generate() !!}
    
    <link rel="stylesheet" href="{{ theme_asset('food/public/css/bootstrap.min.css') }}">
    <link href="{{ theme_asset('food/public/css/remixicon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ theme_asset('food/public/css/hc-offcanvas-nav.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('food/public/css/default.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('food/public/css/style.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('food/public/css/responsive.css') }}">
    @stack('css')
</head>

<body>

    <!-- header area start -->
    @include('theme::layouts.partials.header')
    <!-- header area end -->

    @yield('content')

    <!-- footer area start -->
    @include('theme::layouts.partials.footer')
    <!-- footer area end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ theme_asset('food/public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ theme_asset('food/public/js/store/cart.js') }}"></script>
    <script src="{{ theme_asset('food/public/js/hc-offcanvas-nav.js') }}"></script>
    @stack('js')
    <script src="{{ theme_asset('food/public/js/main.js') }}"></script>
</body>

</html>