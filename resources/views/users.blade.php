@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="row">
        <div class="col-md-12">

            <div class="ui panel panel-default">
                <div class="ui header">All Users</div>
                <div class="ui panel-body">
                    <table class="ui table table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Username</th>
                                @if (Auth::check() && Auth::user()->isAdmin() )
                                    <th>IP</th>
                                    <th>Email</th>
                                    <th>Banned</th>
                                    <th>Action</th>

                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->username }}</td>  
                                @if (Auth::check() && Auth::user()->isAdmin() )
                                    <td>{{ $user->ip }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->banned == 0)
                                        <td>No</td>
                                        <td>
                                            <form class="ui form" method="POST" action="{{ url('/admin/user/banned/') }}">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                                <div class="field">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" class="ui button red">
                                                            <i class="fa fa-btn fa-user"></i>Banned
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    @else
                                        <td>Yes</td>
                                        <td>
                                            <form class="ui form" method="POST" action="{{ url('/admin/user/unbanned') }}">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                                <div class="field">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" class="ui button green">
                                                            <i class="fa fa-btn fa-user"></i>Unbanned
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    @endif
                                @endif                          
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection