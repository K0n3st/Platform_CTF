@extends('layouts.app')

@section('content')
<br><br><br>
<div class="ui container">
    <div class="ui grid">
        <div class="sixteen wide column">
            <div class="ui segment">
                <div class="ui header">Competition</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10">
                            <table class="ui table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Playmode</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Status</th>
                                        <th>Visible</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($competitions as $competition)
                                    <tr>
                                        <td>{{ $competition->id }}</td>
                                        <td>{{ $competition->name }}</td>
                                        <td>{{ $competition->description }}</td>
                                        <td>{{ $competition->playmode }}</td>
                                        <td>{{ $competition->start_date }}</td>
                                        <td>{{ $competition->end_date }}</td>
                                        @if($competition->enabled == 0)
                                            <td>Active</td>
                                        @else
                                            <td>Inactive</td>
                                        @endif
                                        @if($competition->visible == 0)
                                            <td>Yes</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                        <td>
                                            <form action="{{ url('/admin/competition/' . $competition->id. '/delete') }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button class="ui button red" type="submit">Remove</button>
                                            </form><br>
                                            <a href="{{url('/admin/competition/'. $competition->id. '/edit')}}" class="ui button">Manage</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><br>
                        <div class="col-md-2">
                            <a href="{{ url('admin/competition/') }}" class="ui button">See more</a>
                            <a href="{{ url('admin/competition/create') }}" class="ui button blue">Create new competition</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ten wide column">
            <div class="ui segment">
                <div class="ui header">Challenges</div>
                <div class="panel-body">
                    <table class="ui table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Points</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($challenges as $challenge)
                            <tr>
                                <td>{{$challenge->id}}</td>
                                <td>{{$challenge->name}}</td>
                                <td>{{$challenge->description}}</td>
                                @if(is_null($challenge->category))
                                    <td>-</td>
                                @else
                                    <td>{{$challenge->category->name}}</td>
                                @endif
                                <td>{{$challenge->points}}</td>
                                <td>
                                    <form action="{{ url('/admin/challenge/' . $challenge->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">remove</button>
                                    </form><br>
                                
                                    <a href="{{ url('/admin/challenge/' . $challenge->id . '/edit') }}" class="ui button">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                
                    <a href="{{ url('/admin/challenge/') }}" class="ui button">See more list</a>
                    <a href="{{ url('/admin/challenge/create') }}" class="ui blue button">Create new challenge</a>
                </div>
            </div>
        </div>
        <div class="six wide column">
            <div class="ui segment">
                <div class="ui header">Categories</div>
                <div class="panel-body">
                    <table class="ui table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    <form action="{{ url('/admin/category/' . $category->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">remove</button>
                                    </form><br>
                                    <a href="{{ url('/admin/category/' . $category->id . '/edit') }}" class="ui button">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                
                    <a href="{{ url('/admin/category/') }}" class="ui button">See more list</a>
                    <a href="{{ url('/admin/category/create') }}" class="ui button blue">Create new category</a>
                </div>
            </div>
        </div>

        <div class="eight wide column">
            <div class="ui segment">
                <div class="ui header">Banned User</div>
                <div class="panel-body">
                    <form class="ui form" method="POST" action="{{ url('/admin/user/banned') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="field">
                            <label for="" class="control-label">Username</label>
                            <select class="form-control selectpicker" data-live-search="true" name="user_id" id="nameid">
                                @foreach($users as $user)
                                    @if($user->banned == 0)
                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="ui button red">
                                    <i class="fa fa-btn fa-user"></i>Banned
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="eight wide column">
            <div class="ui segment">
                <div class="ui header">Unbanned User</div>
                <div class="panel-body">
                    <form class="ui form" method="POST" action="{{ url('/admin/user/unbanned') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="field">
                            <label for="" class="control-label">Username</label>
                            <select class="form-control" name="user_id">
                                <option></option>
                                @foreach($users as $user)
                                    @if($user->banned == 1)
                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="ui button green">
                                    <i class="fa fa-btn fa-user"></i>Unbanned
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="eight wide column">
            <div class="ui segment">
                <div class="ui header">Hints</div>
                <div class="panel-body">
                    <table class="ui table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Challenge</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hints as $hint)
                            <tr>
                                <td>{{$hint->id}}</td>
                                <td>{{$hint->name}}</td>
                                <td>{{$hint->description}}</td>
                                <td>{{$hint->name_chal}}</td>
                                <td>
                                    <form action="{{ url('/admin/hint/' . $hint->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">Remove</button>
                                    </form><br>
                                    <a href="{{ url('/admin/hint/' . $hint->id . '/edit') }}" class="ui button">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                
                    <a href="{{ url('/admin/hint/') }}" class="ui button">See more list</a>
                    <a href="{{ url('/admin/hint/create') }}" class="ui button blue">Create new hint</a>
                </div>
            </div>
        </div>


        <div class="eight wide column">
            <div class="ui segment">
                <div class="ui header">Head Line Competition</div>
                <div class="panel-body">
                    <form action="{{ url('/admin/headLineCompetition')}}" method="post" class="ui form">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="ui field">
                        <label class="col-md-4 control-label">Competition</label>
                        <select name="headlinecompetition" id="">
                            @foreach($competitions as $competition)
                                @if($headlineCompetition->id == $competition->id)
                                    <option value="{{$competition->id}}" selected>{{$competition->name}}</option>
                                @else
                                    <option value="{{$competition->id}}">{{$competition->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="ui button blue">
                                Change HeadLine Competition 
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection