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
    color: #0e0f0f !important;
    font-weight: 600;
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
            <div class="container h-100 reset_passwrd">
                <div class="row align-items-center justify-content-center h-100">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="col-md-5">
                        <div class="card p-5">
                            <div class="card-body">
                                <div class="auth-logo">
                                    <img src="{{ url('/public/theme/images/sharpmower.jpg')}}" class="img-fluid rounded-normal" alt="logo">
                                </div>
                                <h3 class="mb-3 text-center">Reset Password</h3>
                                <p class="text-center small text-secondary mb-3">You can reset your password here</p>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-lg-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="form-group">
                                                <label class="text-secondary">Email</label>
                                                <input class="form-control" type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">

                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
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