@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui middle aligned center aligned grid">
        <div class="six wide column">
        <h2 class="ui green header">
            <div class="content">
                Sign Up
            </div>
        </h2>
        <div class="ui green segment">
            <form class="ui form" method="POST" action="{{ url('/register') }}">
                @csrf

                <div class="field{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Username</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}">

                    </div>
                    @error('username')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                    </div>
                    @error('name')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('surname') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Surname</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">

                    </div>
                    @error('surname')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                    </div>
                    @error('email')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">

                    </div>
                    @error('password')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">

                    </div>
                    @error('password_confirmation')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="label">
                    <input type="checkbox" name="checkbox" value="política_privacidad">
                    <label for="politica_de_privacidad"><a href="https://www.aleydasolis.com/aviso-legal-privacidad/" target="blank">He leído y acepto la política de privacidad</a></label>
                    @error('checkbox')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><br><br>
                
                <div class="field">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="ui button green">
                            <i class="fa fa-btn fa-user"></i>Register
                        </button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection