@extends('layouts/unlogged')

@section('title', 'World Manager')

@section('content')

<!--  THIS IS THE MAIN CONTENT -->

<div>
    <h2>
        Hello Animal Lover!
    </h2>
</div>

<!--  LOG IN  -->

<div class="well">
    <h3>
        Log in
    </h3>

    <form role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>Email address</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Your email">
            @if ($errors->has('email'))
            <span class="help-block">
                <small>{{ $errors->first('email') }}</small>
            </span>
            @endif
        </fieldset>

        <fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Your password">
            @if ($errors->has('password'))
            <span class="help-block">
                <small>{{ $errors->first('password') }}</small>
            </span>
            @endif
        </fieldset>

        <fieldset class="form-group">
                <label>
                <input type="checkbox" name="remember"> Remember Me
                </label>
        </fieldset>

        <fieldset class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Login
            </button>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </fieldset>
    </form>

</div>

<!--  SIGN IN  -->

<div class="container">
    <h3>
        New in here?
    </h3>

    <a href="register" class="btn btn-default">
        <i class="fa fa-btn fa-user"></i>Register
    </a>
</div>

@endsection