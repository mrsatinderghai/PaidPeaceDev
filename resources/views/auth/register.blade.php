<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'Datum | CRM Admin Dashboard Template') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/theme/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{ url('public/theme/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/theme/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ url('public/theme/css/custom.css') }}">
    <style>
        .text-secondary {
            color: #292a2d !important;
            font-weight: 600;
        }

        span.help-block {
            font-weight: 200;
            color: red;
        }
    </style>
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-5">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="auth-logo">
                                    <img src="{{ url('/public/theme/images/sharpmower.jpg')}}" class="img-fluid rounded-normal" alt="logo">
                                </div>
                                <h3 class="mb-3 font-weight-bold text-center">Getting Started</h3>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label class="text-secondary">Name</label>
                                                <input class="form-control" type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="text-secondary">Email</label>
                                                <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label class="text-secondary">Password</label>
                                                <input class="form-control" type="password" placeholder="Enter Password" name="password">
                                                @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <label class="text-secondary">Confirm Password</label>
                                                <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation">
                                                @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-2 remove_space">
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                    <input type="checkbox" class="custom-control-input m-0" id="inlineCheckbox1">
                                                    <label class="custom-control-label pl-2" for="inlineCheckbox1">I agree to the <a href="#">Terms of Service </a> and <a href="#">Privacy Policy</a></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mt-2">Create Account</button>
                                    <div class="col-lg-12 mt-3">
                                        <p class="mb-0 text-center">Do you have an account? <a href="{{ url('/login') }}">Sign In</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ url('public/theme/js/backend-bundle.min.js') }}"></script>
    <script src="{{ url('public/theme/js/customizer.js') }}"></script>
    <script src="{{ url('public/theme/js/sidebar.js') }}"></script>
    <script src="{{ url('public/theme/js/flex-tree.min.js') }}"></script>
    <script src="{{ url('public/theme/js/tree.js') }}"></script>
    <script src="{{ url('public/theme/js/table-treeview.js') }}"></script>
    <script src="{{ url('public/theme/js/sweetalert.js') }}"></script>
    <script src="{{ url('public/theme/js/vector-map-custom.js') }}"></script>
    <script src="{{ url('public/theme/js/chart-custom.js') }}"></script>
    <script src="{{ url('public/theme/js/charts/01.js') }}"></script>
    <script src="{{ url('public/theme/js/charts/02.js') }}"></script>
    <script src="{{ url('public/theme/js/vendor/emoji-picker-element/index.js.js') }}"></script>
    <script src="{{ url('public/theme/js/app.js') }}"></script>
</body>

</html>