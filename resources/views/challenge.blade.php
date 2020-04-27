@extends('layouts.app')

@section('content')
<br><br><br>
<div class="ui container">
    <h1 class="ui header">
        <a href="{{url('/competition/'. $competition->id)}}"><i class="fa fa-arrow-left"></i>  {{$competition->name}}</a>
    </h1>

    <div class="ui grid">
        <div class="ten wide column">
            @if(isset($status))
                @if($status == 0)
                    <div class="ui negative message">
                        <i class="close icon"></i>
                        <div class="header">
                            Flag Incorrect!
                        </div>
                        <p>You submit the wrong flag.</p>
                    </div>
                @else
                    <div class="ui positive message">
                        <i class="close icon"></i>
                        <div class="header">
                            Correct Flag!
                        </div>
                        <p>You solve this challenge.</p>
                    </div>
                @endif
            @endif

            <div class="ui segment">
                <h4 class="ui header">{{$challenge->category->name}}</h4>

                <h2 class="ui header">
                    {{$challenge->name}}
                    @if($competition->playmode == 'individual')
                        @if(Auth::user()->hasSolved($challenge))
                            <span class="ui teal tag label">solved</span>
                        @endif
                    @else
                        @if($solved)
                            <span class="ui teal tag label">solved</span>
                        @endif
                    @endif
                </h2>
                <p>{{$challenge->description}}</p>

                @if(!empty($hints))
                    @if(!count($hints) == 0)
                        @if(count($used_hints) == 1)
                            <h5>{{$hints[0]->name}}</h5>
                            <p>{{$hints[0]->description}}</p>
                            @if(count($hints) == 2)
                                <button class="ui button"><a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id. '/hint/2/team' )}}">Unlock Hint 2</a></button>
                            @elseif(count($hints) == 3)
                                <button class="ui button"><a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id. '/hint/2/team' )}}">Unlock Hint 2</a></button>
                            @endif
                        @elseif(count($used_hints) == 2)
                            <h5>{{$hints[0]->name}}</h5>
                            <p>{{$hints[0]->description}}</p>
                            <h5>{{$hints[1]->name}}</h5>
                            <p>{{$hints[1]->description}}</p>
                            @if(count($hints) == 3)
                                <button class="ui button"><a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id. '/hint/3/team' )}}">Unlock Hint 3</a></button>
                            @endif 
                        @elseif(count($used_hints) == 3)
                            <h5>{{$hints[0]->name}}</h5>
                            <p>{{$hints[0]->description}}</p>
                            <h5>{{$hints[1]->name}}</h5>
                            <p>{{$hints[1]->description}}</p>
                            <h5>{{$hints[2]->name}}</h5>
                            <p>{{$hints[2]->description}}</p>
                        @elseif(count($used_hints) == 0)
                            <button class="ui button"><a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id. '/hint/1/team' )}}">Unlock Hint 1</a></button>
                        @endif
                    @endif
                @endif


                
<br><br>
                <form action="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id)}}" method="post" class="ui form">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="field">
                        <input type="text" name="flag" class="form-control" placeholder="Insert Flag Here">
                    </div>
                    @if($competition->playmode == 'individual')
                        @if(Auth::user()->hasSolved($challenge))
                            <button type="submit" class="ui button" disabled="True">Submit</button>
                        @else
                            <button type="submit" class="ui button">Submit</button>
                        @endif
                    @else
                        @if($solved)
                            <button type="submit" class="ui button" disabled="True">Submit</button>
                        @else
                            <button type="submit" class="ui button">Submit</button>
                        @endif
                    @endif

                </form>
            </div>
        </div>

        <div class="six wide column">
            <h3 class="ui header">Solved by</h3>
            <table class="ui table">
                <thead>
                    <th>#</th>
                    <th>Time</th>
                    @if($competition->playmode == 'individual')
                        <th>Username</th>
                    @else
                        <th>Name Team</th>
                    @endif
                </thead>
                <tbody>
                    <?php $cont = 0 ?>
                    @foreach ($challenge->getSolver($competition) as $solver)
                        <?php $cont++ ?>
                        <tr>
                            <td>{{$cont}}</td>
                            <td>{{$solver->time}}</td>
                            <td>
                                @if($competition->playmode == 'individual')
                                    {{$solver->getUser()->username}}&nbsp&nbsp
                                @else
                                    {{$solver->getTeam()->name}}&nbsp&nbsp
                                @endif
                                @if ($cont <= 3)
                                    <a class="ui green circular label">{{$cont}}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection