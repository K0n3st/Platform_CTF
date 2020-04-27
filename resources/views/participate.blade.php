@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="ui middle aligned center aligned grid">
        <div class="eight wide column">
            <h2 class="ui teal header">
                <div class="content">Confirm Participation</div>
            </h2>
            <div class="ui teal segment">
                <h1 class="header">{{ $competition->name }}</h1>
                <p>{{ $competition->description }}</p><br>

                <form action="{{url('/participate/'. $competition->id)}}" method="post">
                    @csrf
                    <button type="submit" class="ui button teal">Participate</button>
                    <a href="{{url('/competition')}}" class="ui button red">Cancel</a>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection