@extends('layouts.app')

@section('content')
<br><br><br><br>

<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui red header">
            <div class="content">
                Login Team
            </div>
        </h2>
        <div class="ui red segment">
            <form action="{{ url('/participate/'.$competition->id. '/teamParticipate/loginTeam') }}"  method="POST" class="ui form">
                @csrf

                <div class="field{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>Name</label>

                    <div class="ui huge  icon input">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="ui huge icon input">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="ui button red">
                            <i class="fa fa-plus"></i>  Login Team
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection