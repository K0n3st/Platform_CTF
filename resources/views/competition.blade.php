@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="ui grid">
        <div class="ten wide column left aligned">
            <h1>{{$competition->name}}</h1>
            <h4>{{$competition->description}}</h4>
        </div>

        <div class="six wide column right aligned">
            <h5>
                <time title="{{$competition->start_date}}">
                    Start: {{Carbon\Carbon::parse($competition->start_date)->diffForHumans()}}
                </time>
            </h5>
            <h5>
                <time title="{{$competition->end_date}}">
                    End: {{Carbon\Carbon::parse($competition->end_date)->diffForHumans()}}
                </time>
            </h5>
        </div>
    </div>

    <div class="ui grid">
        <div class="ten wide column">
            @foreach($categories as $category)
                <h3>{{$category->name}}</h3>
                <table class="ui table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Challenge Name</th>
                            <th>Total Solver</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($competition->challenges->where('category_id', $category->id) as $challenge)
                            @if($challenge->pivot->visible == 0)
                                <tr>
                                    <td>{{$challenge->id}}</td>
                                    <td>
                                        <a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id)}}">{{$challenge->name}}</a>              
                                        @if($competition->playmode == 'individual')
                                            @if(Auth::user()->hasSolved($challenge))
                                                <span class="ui teal tag label">Solved</span>
                                            @endif
                                        @else
                                            @if(Auth::user()->hasSolvedTeam($competition,$challenge))
                                                    <span class="ui teal tag label">Solved</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{count($challenge->getSolver($competition))}}</td>
                                    <td>{{ $challenge->pivot->points }}</td>
                                    <td>
                                        <a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id)}}" class="ui button">Solve</a>
                                    </td>
                                </tr>
                            @else
                                <tr></tr>
                            @endif
                        @empty
                        @endforelse
                    </tbody>
                </table>
            @endforeach
        </div>

        <div class="six wide column">
            <h3 class="ui header">Leaderboard</h3>
            @include('partials.scoreboard', [
                'data' => $data,
                'competition' => $competition,
                'useLatestSubmit' => True
            ])

            <h3 class="ui header">Most Solved</h3>
            @include('partials.recommendedProb', [
                'data' => $competition->getSortedChallenges(),
            ])
        </div>
        </div>
    </div>
</div>
@endsection