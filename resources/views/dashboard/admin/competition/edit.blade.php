@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="ui grid">

        <div class="five wide column">

            <div class="ui segment">
                <div class="ui header">Edit Competition</div>
                <div>
                    <form class="ui form" method="POST" action="{{ url('/admin/competition/' . $competition->id) }}">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="field">
                            <label for="" class="control-label">Competition Name</label>
                            <input type="text" class="form-control" name="name" value="{{$competition->name}}" required>
                            @error('name')
                                <span class="invalid-feedback red">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="" class="control-label">Competition Description</label>
                            <textarea type="text" class="form-control" name="description" rows="10" required>{{$competition->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback red">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="" class="control-label">Playmode</label>
                            <select class="form-control" name="playmode" value="{{$competition->playmode}}">
                                @if($competition->playmode == 'individual')
                                    <option selected>Individual</option>
                                    <option>Team</option>
                                @else
                                    <option>Individual</option>
                                    <option selected>Team</option>
                                @endif
                            </select>
                        </div>

                        <div class="field">
                            <label for="" class="control-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{$competition->start_date}}" min="{{Carbon\Carbon::now()}}" required></end_date>
                            @error('start_date')
                                <span class="invalid-feedback red">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="" class="control-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{$competition->end_date}}" required></end_date>
                            @error('end_date')
                                <span class="invalid-feedback red">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field">
                            <button type="submit" class="ui button blue">
                                <i class="fa fa-btn fa-sign-in"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="six wide column">
            <div class="ui segment">
                <div class="ui header">Competition Statistic</div>
                <div>
                    <table class="ui table">
                        <tbody>
                            <tr>
                                <td>Participants</td>
                                @if($competition->playmode == 'individual')
                                    <td>{{$competition->participations->count()}}</td>
                                @else
                                    <td>{{$competition->participationteams->count()}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Total Done</td>
                                @if($competition->playmode == 'individual')
                                    <td>{{$competition->dones->count()}}</td>
                                @else
                                    <td>{{$competition->donesteam->count()}}</td>
                                @endif
                            <tr>
                                <td>Total correct dones</td>
                                <td>{{count($competition->getCorrectDone())}}</td>
                            </tr>                            </tr>
                            <tr>
                                <td>Challenges</td>
                                <td>{{$competition->challenges()->count()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="five wide column">
            <div class="ui segment">
                <div class="ui header">Action</div>
                <form class="ui form" method="POST" action="{{ url('/admin/competition/' . $competition->id. '/activate') }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="field">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="ui button green">
                                Activate Competition
                            </button>
                        </div>
                    </div>
                </form><br>
                <form class="ui form" method="POST" action="{{ url('/admin/competition/' . $competition->id.'/deactivate') }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="field">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="ui button red">
                            Deactivate Competition
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="ui segment">
                <div class="ui header">Visible</div>
                <form class="ui form" method="POST" action="{{ url('/admin/competition/' . $competition->id. '/unhide') }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="field">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="ui button green">
                                Unhide Competition
                            </button>
                        </div>
                    </div>
                </form><br>
                <form class="ui form" method="POST" action="{{ url('/admin/competition/' . $competition->id.'/hide') }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="field">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="ui button red">
                                Hide Competition
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <div class="ui grid">
        <div class="eight column wide">
            <div class="ui segment">
                <div class="ui header">Challenges</div>
                <div>
                    <div class="eight column wide">

                        <form action="{{ url('/admin/competition/' . $competition->id . '/challenge') }}" method="POST" class="ui form inline?">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="field">
                                <div class="eight wide column">
                                    <select class="form-control" name="challenge_id">
                                        @foreach($challenges as $challenge)
                                            <option value="{{$challenge->id}}">{{$challenge->name}}</option>
                                        @endforeach
                                    </select>
                                </div><br>


                                <div class="six wide column">
                                    <input type="number" class="form-control" name="challenge_points" placeholder="points" min="1" required>
                                </div><br>
                                <div class="two wide column">
                                    <input class="ui button" type="submit">
                                </div>
                            </div>
                        </form>
                    </div><br><br>

                    <div class="fourteen column wide">
                        <h3>Added</h3>
                        <table class="ui table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Points</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($competition->challenges as $challenge)
                                <tr>
                                    <td>{{$challenge->id}}</td>
                                    <td>{{$challenge->category->name}}</td>
                                    <td>{{$challenge->name}}</td>
                                    <td>{{$challenge->description}}</td>
                                    <td>{{$challenge->pivot->points}}</td>
                                    @if($challenge->pivot->visible == 0)
                                        <td><br><br>
                                            <form action="{{ url('/admin/competition/' . $competition->id. '/challenge/' . $challenge->id. '/hide') }}" method="POST">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <input name="points" value="{{$challenge->pivot->points}}" type="hidden">
                                                <button class="ui button green" type="submit">Hide</button>
                                            </form><br><br>
                                        </td>
                                    @else
                                        <td><br><br><br>
                                            <form action="{{ url('/admin/competition/' . $competition->id. '/challenge/' . $challenge->id. '/unhide') }}" method="POST">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                
                                                <input name="points" value="{{$challenge->pivot->points}}" type="hidden">
                                                <button class="ui button red" type="submit">Unhide</button>
                                            </form><br><br>
                                        </td>
                                    @endif
                                    <td>

                                    <form action="{{ url('/admin/competition/' . $competition->id. '/challenge/' . $challenge->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">Remove</button>
                                    </form><br><br>
                                    <a href="{{ url('/admin/challenge/'. $challenge->id . '/edit') }}" class="ui button">Edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                

                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br>
    <div class="row">
        <div class="eight column wide">
            <div class="ui segment">
                <div class="ui header">Dones</div>
                <div class="panel-body">
                    <table class="ui table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                @if($competition->playmode == 'individual')
                                    <th>User</th>
                                @else
                                    <th>Team Name</th>
                                @endif
                                <th>Challenge</th>
                                <th>Answer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($competition->playmode == 'individual')
                                @foreach($competition->dones as $done)
                                
                                <tr>
                                    <td>{{$done->id}}</td>
                                    <td>{{$done->time}}</td>
                                    @if($competition->playmode == 'individual')
                                        <td>
                                            <a href="{{ url('/user/' . $done->participation->user->id) }}">
                                                {{$done->participation->user->username}}
                                            </a>
                                        </td>
                                    @else
                                        <td>{{$done->participationteams->team->name}}</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/competition/' . $competition->id . '/challenge/' . $done->challenge->id) }}">
                                        {{$done->challenge->name}}
                                        </a>
                                    </td>
                                    <td>{{$done->flag}}</td>
                                    @if($done->status == 1)
                                        <td>Correct</td>
                                    @else
                                        <td>Incorrect</td>
                                    @endif

                                </tr>
                                @endforeach
                            @else
                                @foreach($competition->donesteam as $done) 
                                    <tr>
                                        <td>{{$done->id}}</td>
                                        <td>{{$done->time}}</td>
                                        <td>{{$done->participationTeam->team->name}}</td>
                                        <td>
                                            <a href="{{ url('/competition/' . $competition->id . '/challenge/' . $done->challenge->id) }}">
                                            {{$done->challenge->name}}
                                            </a>
                                        </td>
                                        <td>{{$done->flag}}</td>
                                        @if($done->status == 1)
                                            <td>Correct</td>
                                        @else
                                            <td>Incorrect</td>
                                        @endif

                                    </tr>
                                    @endforeach
                                @endif
                        </tbody>
                    </table>            
                </div>
            </div>
        </div>
    </div>
<br><br>
    <div class="row">
        <div class="eight column wide">
            @include('partials.scoreboard', ['data' => $data])
        </div>
    </div>
<br><br>
</div>
@endsection