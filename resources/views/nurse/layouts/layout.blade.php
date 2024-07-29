<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('nurse/assets/imgs/template/favicon.png')}}">
   <meta name="csrf-token" content="{{ csrf_token() }}">

     <link rel="stylesheet" type="text/css" href="{{ asset('nurse/assets/css/stylecd4e.css?version=4.1')}}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <script src="https://kit.fontawesome.com/107d2907de.js" crossorigin="anonymous"></script>
    
     <title>{{ env('APP_NAME') }}</title>
  </head>

<body class="home">
    <div class="page-wrapper">
            @include('nurse.layouts.header')
             @yield('css')
            @include('nurse.layouts.style')
            @yield('content')
        
        @include('nurse.layouts.footer')
        @include('nurse.layouts.js')
        @yield('js')
      </body>

</html>
