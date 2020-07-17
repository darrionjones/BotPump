<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "BotPump" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-white.png') }}?v=2111">

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons/ionicons.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte/skins/skin-blue.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/icheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a style="text-align:center;" href="/"><img src="{{ asset('img/logo-white-trans.png') }}"></a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Create a new account</p>

        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}

            @if ($errors->has('name'))
                <div style="color: red;">{{ $errors->first('name') }}</div>
            @endif
            <div class="form-group {{ $errors->has('name') ? ' has-error' : 'has-feedback' }}">
                <input id="name" name="name" type="text" class="form-control" placeholder="Full name" value="{{ old('name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            @if ($errors->has('email'))
                <div style="color: red;">{{ $errors->first('email') }}</div>
            @endif
            <div class="form-group {{ $errors->has('email') ? ' has-error' : 'has-feedback' }}">
                <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            @if ($errors->has('password'))
                <div style="color: red;">{{ $errors->first('password') }}</div>
            @endif
            <div class="form-group {{ $errors->has('password') ? ' has-error' : 'has-feedback' }}">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Retype password" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <!--div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div-->
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <!--div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                Google+</a>
        </div-->

        <a href="{{ route('login') }}" class="text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>
<script src="{{ asset('plugins/icheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>