@extends('layouts.app')

@section('content')

<style>
    .hidden.menu{
        display: none
    }
</style>

<div class="ui inverted vertical masthead segment">
    <div class="ui container">
        <div class="ui large secondary inverted pointing menu">
            <a class="toc item">
                <i class="sidebar icon"></i>
            </a>
            <a href="{{ url('/') }}" class="active item">Home</a>
            <a href="{{ url('competition') }}" class="item">Competition</a>
            <a href="{{ url('users') }}" class="item">Users</a>
            @if (Auth::check() && Auth::user()->isAdmin() )
                <a class="item" href="{{ url('/admin') }}">Admin</a>
            @endif

            <div class="right item">
                @if (Auth::guest())
                    <a class="ui inverted button" href="{{ url('/login') }}">Log in</a>
                    <a class="ui inverted button" href="{{ url('/register') }}">Sign Up</a>
                @else
                    <div class="ui simple dropdown item">
                        {{Auth::user()->username }}<i class="dropdown icon"></i>
                        <div class="menu">
                            <a href="{{ url('/user/' . Auth::user()->id) }}" class="item">Profile</a>
                            <a href="{{ url('logout') }}" class="item">Log out</a>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div><br>

    <div class="ui center aligned text container">
        <h2 class="ui inverted header">Capture The Flag</h2>
        <h4>Learn Hacking with K0n3st</h4>
    </div><br>

    <div class="ui container">
        <div class="ui equal width grid">
            <div class="column">
                <h1 class="ui header inverted">
                    @if(!$headlineCompetition == '-')
                        <h1>Name Competition</h1>                                     
                    @else
                        {{ $headlineCompetition->name }}
                        @if ($headlineCompetition->isOngoing())
                            <div class="ui teal label">Ongoin</div>
                        @elseif ($headlineCompetition->isFinished())
                            <div class="ui label">Finished</div>
                        @endif
                    @endif
                </h1>
                @if(!$headlineCompetition == '-')
                    <p>Description of Competition</p>
                @else
                    <p> {{ $headlineCompetition->description }}</p>
                             
                    @if (Auth::check() && Auth::user()->isParticipate($headlineCompetition) )
                        @if(!$headlineCompetition->isFinished())
                            @if($headlineCompetition->enabled == 0)
                                <a href="{{ url('/competition/' . $headlineCompetition->id) }}" class="ui huge inverted green button">Continue</a>
                            @else
                                <button disabled="disabled" class="ui huge inverted green button"><a href="{{ url('/competition/' . $headlineCompetition->id) }}" class="white">Continue</a></button>
                            @endif
                        @endif
                    @else
                        <a href="{{ url('/competition/' . $headlineCompetition->id ) }}" class="ui huge inverted button">Join</a>
                    @endif
                    <a href="{{ url('/competition/'. $headlineCompetition->id .'/leaderboard') }}" class="ui huge blue inverted button">Leaderboard</a>
                @endif
            </div>

            <div class="four wide column">
                @if (Auth::guest())
                <h2 class="ui header inverted">Log in</h2>
                <form action="{{ url('/login') }}" method="post" class="ui form">
                    @csrf

                    <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="ui icon input">
                            <input type="email" placeholder="email" class="form-control"  value="{{ old('name') }}" name="email">
                                                        
                        </div>
                        @error('email')
                            <span class="invalid-feedback red">
                                <strong><br>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field{{ $errors->has('password') ? 'has-error' : '' }}">
                        <div class="ui icon input">
                            <input type="password" placeholder="password" class="form-control" name="password">

                        </div>
                        @error('password')
                            <span class="invalid-feedback red">
                                <strong><br>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="remember">
                            <label for="remember" class="invertd">Remember Me</label>
                        </div>
                    </div>
                    <button type="submit" class="ui blue submit button">Login</button>
                </form>
                @else
                    <div class="text container">
                        <h1 class="ui header inverted"><small>Hello,</small><br>{{ Auth::user()->username }}</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable very relaxed grid container">
        <div class="row">
            <div class="eight wide column">
                <h2 class="ui header">Latest Competitions</h2>
                @foreach ($competitions as $competition)
                    <h3 class="ui header">
                    {{ $competition->name }}    
                    @if ($competition->isOngoing())
                            <div class="ui teal label">Ongoing</div>
                        @elseif ($competition->isFinished())
                            <div class="ui teal label">Finished</div>
                        @endif
                    </h3>
                    <p> {{ $competition->description }}</p>

                    @if (Auth::check() && Auth::user()->isParticipate($competition))
                        @if(!$competition->isFinished())
                            @if($competition->enabled == 0)
                                <a href="{{ url('/competition/' . $competition->id) }}" class="ui large inverted green button">Continue</a>
                            @else    
                                <button disabled="True" class="ui large inverted green button"><a href="{{ url('/competition/' . $competition->id) }}">Continue</a></button>
                            @endif
                        @endif
                    @else
                        @if(!$competition->isFinished())
                            @if($competition->enabled == 0)
                                <a href="{{ url('/competition/' . $competition->id) }}" class="ui large inverted blue button">Join</a>
                            @else
                                <button disabled="True" class="ui large inverted blue button"><a href="{{ url('/competition/' . $competition->id) }}">Join</a></button>
                            @endif
                        @endif
                        
                    @endif
                        <a href="{{ url('/competition/'.  $competition->id  .'/leaderboard') }}" class="ui large inverted blue button">Leaderboard</a>
                @endforeach <br><br><br>

            <a href="{{ url('competition') }}" class="ui large button">More competitions</a>
            </div>
            <div class="ui vertical divider">
                Or
            </div>
            <div class="four wide column">
                <h3>Last Week's Leaderboard</h3>
                @if(!$headlineCompetition == '-')
                    <p>None</p>
                @else
                    @if (isset($showLastWeekLeaderboard) && $showLastWeekLeaderboard)
                        @include('partials.scoreboard',[
                            'data' => $lastWeekCompetition->getFinalScoreBoardData()    
                        ])
                        <a href="{{ url('/competition/'. $lastWeekCompetition->id .'/leaderboard') }}" class="ui large button">Full Leaderboard</a>
                    @else
                        <p>No data to be shown</p>
                    @endif
                @endif
            </div>
            <div class="four wide column">
                <h3>All Time Top Ten</h3>
                <table class="ui table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont = 1; ?>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $cont}}</td>
                                <td>{{ $row->username}}</td>
                                <td>{{ $row->points}}</td>
                            </tr>
                            <?php $cont++; ?>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical stripe segment">
    <h2 class="ui header center aligned">Categories</h2>
    <div class="ui middle aligned stackable grid container">
        @foreach ($categories as $category)
            <div class="four wide column">
                <div class="ui grey segment center aligned">
                    <h3 class="ui header">{{ $category->name}}</h3>
                    <p€>{{ $category->description}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('tail')
<script>
    $(document).ready(function(){
        $('.masthead').visibility({
            once:false,
            onBottomPassed: function(){
                $('.fixed.menu').transition('fade in');
            },
            onBottomPassedReverse: function(){
                $('.fixed.menu').transition('fade out');
            }
        });
    });
</script>
@endsection