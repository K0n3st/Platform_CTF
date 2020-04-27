@extends('layouts.app')

@section('content')
<div class="ui container"><br><br>
    @if(count($data) == 0)
        <h1>No hay usuarios registrados Todavía</h1>
    @else
        <h1>Leaderboard</h1>
        <h2>{{ $data[0]->name }}</h2>
        <h4>{{ $data[0]->description }}</h4><br>

        <div class="ui grid">
            <div class="eight wide column">
                @include('partials.scoreboard', [
                    'data' => $data,
                    'useLatestSubmit' => True
                ])
            </div>
        </div>
    @endif
</div>
@endsection