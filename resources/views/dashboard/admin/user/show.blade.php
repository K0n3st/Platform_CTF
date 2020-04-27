@extends('layouts.app')

@section('content')
<br>
<div class="ui container">

    <h1 class="ui header">Profile User</h1>

    <div class="ui grid">
        <div class="six wide column">
            <div class="ui segment">
                <h3 class="ui header">User Information</h3>
                <table class="ui table">
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Surname</td>
                            <td>{{ $user->surname }}</td>
                        </tr>
                        @if (Auth::check() && Auth::user()->isAdmin() )
                            <tr>
                                <td>IP</td>
                                <td>{{ $user->ip }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="ten wide column">
            <div class="ui segment">
                <h1 class="ui header">Participations</h1>
                <table class="ui table">
                    <thead>
                        <th>#</th>
                        <th>Competition Name</th>
                        <th>Position</th>
                        <th>Points</th>
                    </thead>
                    <tbody>
                        @foreach($user->participations as $participation)
                        <?php $cont = 1; ?>
                            <tr>
                                <td>{{ $participation->id}}</td>
                                <td>{{ $participation->competition->name}}</td>
                                @foreach($data as $row)
                                    @if($row->id == $participation->competition->id)
                                        @if($row->username == $user->username)
                                            <td>{{$cont}}</td>
                                        @else
                                            <?php $cont++ ?>
                                        @endif
                                    @endif
                                @endforeach
                                <td>{{ $participation->points}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>