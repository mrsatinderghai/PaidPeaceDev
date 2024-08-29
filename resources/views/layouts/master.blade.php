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