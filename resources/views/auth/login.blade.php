@extends('layouts.app')

@section('content')
<br><br><br><br>

<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui red header">
            <div class="content">
                Log in
            </div>
        </h2>
        <div class="ui red segment">
            <form action="{{ url('/login') }}"  method="POST" class="ui form">
                @csrf

                <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Email</label>

                    <div class="ui huge icon input">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">

                    </div>
                    @error('email')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="ui huge icon input">
                        <input type="password" class="form-control" name="password">

                    </div>
                    @error('password')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="remember"> 
                        <label class="inverted">Remember Me</label>
                    </div>
                </div>

                <div class="field">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="ui button red">
                            <i class="fa fa-btn fa-sign-in"></i>Login
                        </button>

                        <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection