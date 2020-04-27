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

                <a href="{{url('/participate/'.$competition->id. '/teamParticipate')}}" class="ui button teal">Participate</a>
                <a href="{{url('/competition')}}" class="ui button red">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection