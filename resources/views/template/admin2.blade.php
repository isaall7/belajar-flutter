<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backendd/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backendd/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('backendd/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backendd/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('backendd/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('backendd/modules/summernote/summernote-bs4.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backendd/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('backendd/css/components.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
     <!-- navbar -->
     @include('layouts.backk.navbar')
     <!-- end navbar -->
    
     <!-- sidebar -->
     @include('layouts.backk.sidebar')
     <!-- end sidebar -->

      <!-- Main Content -->
      <div class="main-content">
        <!-- konten -->
        @yield('content')
        <!-- end konten -->
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2025 <div class="bullet"></div> Website By <a href="https://nauval.in/">Ade Faisal</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('backendd/modules/jquery.min.js')}}"></script>
  <script src="{{asset('backendd/modules/popper.js')}}"></script>
  <script src="{{asset('backendd/modules/tooltip.js')}}"></script>
  <script src="{{asset('backendd/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('backendd/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('backendd/modules/moment.min.js')}}"></script>
  <script src="{{asset('backendd/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('backendd/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('backendd/modules/chart.min.js')}}"></script>
  <script src="{{asset('backendd/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('backendd/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('backendd/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('backendd/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('backendd/js/page/index-0.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{asset('backendd/js/scripts.js')}}"></script>
  <script src="{{asset('backendd/js/custom.js')}}"></script>
  @stack('script')
</body>
</html>