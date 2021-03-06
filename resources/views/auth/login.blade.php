@extends('layouts.app')

@section('content')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Sinking</b>Fund</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                @if ($errors->has('email'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="form-group has-feedback">
                <input type="email" name="email"  class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="form-group has-feedback">
                <input type="password"  name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>

           

            <a href="{{ route('password.request') }}">I forgot my password</a><br>
            <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

        </div>
        <!-- /.login-box-body -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
@endsection
