@extends('auth')
@section('body-class','login-page')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{site_url('admin')}}"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            {!! validation_errors('<div class="alert alert-danger">','</div>') !!}
            {!! get_alert_messages() !!}
            <form action="{{get_current_url()}}" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="username" value="{{set_value('username')}}" class="form-control"
                           placeholder="Username or email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" value="1"> Remember Me
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

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign
                    in
                    using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign
                    in
                    using
                    Google+</a>
            </div>
            <!-- /.social-auth-links -->

            <a href="{{site_url('reset-password')}}">I forgot my password</a><br>
            <a href="{{site_url('register')}}" class="text-center">Register</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

@endsection
