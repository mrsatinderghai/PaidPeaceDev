<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name', 'Datum | CRM Admin Dashboard Template') }}</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('public/theme/images/favicon.ico') }}">

  <link rel="stylesheet" href="{{ asset('public/theme/css/backend-plugin.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/css/backend.css?v=1.0.0') }}">
  <link rel="stylesheet" href="{{ asset('public/theme/css/custom.css') }}">




  
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/flick/jquery-ui.css">
  <link href="{{ URL::asset('public/css/jexly.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
  <!-- loader Start -->
  <div id="loading">
    <div id="loading-center">
    </div>
  </div>

  <div class="wrapper">
    @include('layouts.sidebar')
    @include('layouts.header')
    @yield('content')
  </div>

  @include('layouts.footer')





  <script src="{{ asset('public/theme/js/backend-bundle.min.js') }}"></script>
  <script src="{{ asset('public/theme/js/customizer.js') }}"></script>
  <script src="{{ asset('public/theme/js/sidebar.js') }}"></script>
  <script src="{{ asset('public/theme/js/flex-tree.min.js') }}"></script>
  <script src="{{ asset('public/theme/js/tree.js') }}"></script>
  <script src="{{ asset('public/theme/js/table-treeview.js') }}"></script>
  <script src="{{ asset('public/theme/js/sweetalert.js') }}"></script>
  <script src="{{ asset('public/theme/js/vector-map-custom.js') }}"></script>
  <script src="{{ asset('public/theme/js/chart-custom.js') }}"></script>
  <script src="{{ asset('public/theme/js/charts/01.js') }}"></script>
  <script src="{{ asset('public/theme/js/charts/02.js') }}"></script>
  <script src="{{ asset('public/theme/js/vendor/emoji-picker-element/index.js.js') }}"></script>
  <script src="{{ asset('public/theme/js/app.js') }}"></script>


</body>

</html>