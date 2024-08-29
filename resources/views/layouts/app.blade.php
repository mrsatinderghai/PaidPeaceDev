<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sharp Mower CRM</title>

    <script src="https://use.fontawesome.com/239f71a455.js"></script>
    <!-- Fonts -->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/flick/jquery-ui.css">
    <link href="{{ URL::asset('public/css/jexly.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/datetimepicker/jquery.datetimepicker.css') }}">
    {{-- <link href="{{ elixir('public/css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        });
    </script>


    {{-- <script src="{{ elixir('pubic/js/app.js') }}"></script> --}}
</head>
<body id="app-layout" data-spy="scroll" data-target="#myScrollspy">
    <nav class="navbar navbar-default navbar-custom">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ URL::asset('public/img/sharpmower.jpg') }}" height="50px" width="100px" style="margin-top: -15px" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                @if(! Auth::guest())
                @if (Auth::user()->has_role('Admin'))
                    <li>
                        <a href="{{ url('/customer') }}">
                            <i class="fa fa-users"></i> Customers
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/work_order') }}">
                            <i class="fa fa-list-alt"></i> Work Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('work_order/shop_work') }}">
                            <i class="fa fa-wrench"></i> Shop Work
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/work_order/schedule') }}">
                            <i class="fa fa-calendar"></i> Schedule
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/work_order/schedule_for_delivery') }}">
                            <i class="fa fa-truck"></i> Schedule for Delivery
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/invoice') }}">
                            <i class="fa fa-usd"></i> Finances
                        </a>
                    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-lock"></i> Admin
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
                                <li><a href="{{ url('/user') }}"><i class="fa fa-user"></i> Users</a></li>
                                <li><a href="{{ url('/role') }}"><i class="fa fa-key"></i> Roles</a></li>
                                <li><a href="{{ url('/truck') }}"><i class="fa fa-truck"></i> Trucks</a></li>
                                <li><a href="{{ url('/zipcodearea') }}"><i class="fa fa-map"></i> Zip Codes</a></li>
                                <li><a href="{{ url('/export') }}"><i class="fa fa-download"></i> Export</a></li>
                            </ul>
                        </li>
                    @else
                    <li>
                        <a href="{{ route('work_order.my_schedule') }}">
                            <i class="fa fa-calendar"></i> Schedule
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('work_order.create') }}">
                            <i class="fa fa-users"></i> New Work Order
                        </a>
                    </li>
                    @endif
                    @endif
                </ul>



                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> Register</a></li>
                    @else
                        <li><a href="{{ url('/team/'.Auth::user()->team_id) }}"><i class="fa fa-building-o"></i>&nbsp {{ Auth::user()->team->name }}</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user"></i>&nbsp{{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/'.Auth::user()->id) }}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @yield('scripts')
    


</body>
</html>
