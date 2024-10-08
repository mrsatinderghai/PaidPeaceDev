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

</head>

<body>
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
                        <div class="card">
                            <div class="card-body login_page">
                                <div class="auth-logo">
                                    <img src="{{ url('/public/theme/images/sharpmower.jpg')}}" class="img-fluid rounded-normal" alt="logo">
                                </div>
                                <h2 class="mb-2 text-center">Sign In</h2>
                                <p class="text-center">To Keep connected with us please login with your personal info.</p>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong class="text-red">{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>Password</label>
                                                <input class="form-control" type="password" name="password" placeholder="********">
                                                @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong class="text-red">{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 remove_space">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="{{ url('/password/reset') }}" class="text-primary float-right">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <span>Create an Account <a href="{{ url('/register') }}" class="text-primary">Sign Up</a></span>
                                        <button type="submit" class="btn btn-primary">Sign In</button>
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