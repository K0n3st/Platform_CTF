@extends('layouts.app')

@section('content')
<br><br><br><br>

<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui red header">
            <div class="content">
                Create Hint
            </div>
        </h2>
        <div class="ui red segment">
            <form class="ui form" method="POST" action="{{ url('/admin/hint') }}">
                @csrf

                <div class="field">
                    <label for="" class="control-label">Name</label>
                    <select class="form-control" name="name">
                            <option>Pista 1</option>
                            <option>Pista 2</option>
                            <option>Pista 3</option>
                    </select> 
                </div>

                <div class="field">
                    <label for="" class="control-label">Description</label>
                    <textarea name="description" cols="30" rows="10" class="form-control" required></textarea>
                </div>


                <div class="field">
                    <label for="" class="control-label">Challenge</label>
                    <select class="form-control" name="challenge_id">
                        @foreach($challenges as $challenge)
                            <option value="{{$challenge->id}}">{{$challenge->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="ui button blue">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection