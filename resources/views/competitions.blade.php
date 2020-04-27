@extends('layouts.app')

@section('content')
<br>
<div class="ui container"><br>
    <h1 class="ui header">Competition</h1>
    <div class="ui grid">
        <div class="ten wide column">
            @foreach ($competitions as $competition)
                @if($competition->visible == 0)
                    <div class="ui raised segment">
                        @if ($competition->isOnGoing())
                            <a class="ui teal left ribbon label">Ongoing</a>
                        @elseif ($competition->isFinished())
                            <a class="ui teal left ribbon label">Finished</a>
                        @endif

                        <span class="ui header">{{$competition->name}}</span>
                        <p>{{$competition->description}}</p>
                        <p>Playmode: {{$competition->playmode}}</p>
                        <p>Time: {{$competition->start_date}} - {{$competition->end_date}}</p>
                        @if($competition->playmode == 'individual')
                            <p> Participants: {{$competition->participations->count()}}</p>
                        @else
                            <p> Participants: {{$competition->participationteams->count()}}</p>
                        @endif

                        @if(Auth::check() && Auth::user()->isParticipate($competition))
                            @if(!$competition->isFinished())
                                @if($competition->enabled == 1)
                                    <button disabled="True" class="ui button"><a href="{{ url('/competition/'. $competition->id) }}" >Continue</a></button>
                                @else
                                    <a href="{{ url('/competition/'. $competition->id) }}" class="ui button green inverted">Continue</a>
                                @endif
                            @endif
                        @else
                            @if(!$competition->isFinished())
                                @if($competition->enabled == 1)
                                    <button disabled="True" class="ui button"><a href="{{ url('/competition/'. $competition->id) }}" disabled="True">Join</a></button>
                                @else
                                    <a href="{{ url('/competition/'. $competition->id) }}" class="ui button blue inverted">Join</a>
                                @endif
                            @endif
                        @endif
                            <a href="{{ url('/competition/'. $competition->id .'/leaderboard') }}" class="ui button blue inverted">Leaderboard</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection