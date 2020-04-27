@extends('layouts.app')

@section('content')
<br><br><br><br>

<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui red header">
            <div class="content">
                Create Competition
            </div>
        </h2>
        <div class="ui red segment">
            <form action="{{ url('/admin/competition') }}"  method="POST" class="ui form">
                @csrf

                <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Name</label>

                    <div class="ui huge icon input">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                    </div>
                    @error('name')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Description</label>

                    <div class="ui huge left icon input">
                        <textarea name="description"  rows="1" required></textarea>

                    </div>
                    @error('description')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('enabled') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Enabled</label>
                    <div class="form-group">
                        <select class="form-control" name="enabled">
                        <option value="0">Yes</option>
                        <option value="1">No</option>
                        </select>
                    </div>
                </div>

                <div class="field{{ $errors->has('visible') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Visible</label>
                    <div class="form-group">
                        <select class="form-control" name="visible">
                        <option value="0">Yes</option>
                        <option value="1">No</option>
                        </select>
                    </div>
                </div>

                <div class="field{{ $errors->has('playmode') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Playmode</label>
                    <div class="form-group">
                        <select class="form-control" name="playmode">
                        <option>Individual</option>
                        <option>Team</option>
                        </select>
                    </div>
                </div>


                <div class="field{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Start Date</label>

                    <div class="ui huge icon input">
                        <input type="datetime"  name="start_date" placeholder="aaaa-mm-dd"  required>
                    </div>
                    @error('start_date')
                        <span class="invalid-feedback red">
                            <strong><br>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field{{ $errors->has('end_date') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">End Date</label>

                    <div class="ui huge icon input">
                        <input type="date"  name="end_date" placeholder="aaaa-mm-dd" required>

                    </div>
                    @error('end_date')
                        <span class="help-block text-danger">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
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