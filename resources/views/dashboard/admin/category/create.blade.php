@extends('layouts.app')

@section('content')
<br><br><br><br>

<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui red header">
            <div class="content">
                Create Category
            </div>
        </h2>
        <div class="ui red segment">
            <form action="{{ url('/admin/category') }}"  method="POST" class="ui form">
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

                <div class="field{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Description</label>

                    <div class="ui huge left icon input">
                        <textarea name="description"  rows="1" required></textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="ui button blue">
                            <i class="fa fa-plus"></i>  Create
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection