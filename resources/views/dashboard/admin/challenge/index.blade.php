@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="row">
        <div class="col-md-12">

            <div class="ui panel panel-default">
                <div class="ui header">All Challenges</div>
                <div class="panel-body">
                    <table class="ui table table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Points</th>
                                <th>Flag</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($challenges as $challenge)
                            <tr>
                                <td>{{ $challenge->id }}</td>
                                <td>{{ $challenge->name }}</td>
                                <td>{{ $challenge->description }}</td>
                                <td>{{ $challenge->category->name }}</td>
                                <td>{{ $challenge->points }}</td>
                                <td>{{ $challenge->flag }}</td>
                                <td>
                                    <form action="{{ url('/admin/challenge/' . $challenge->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">remove</button>
                                    </form><br>
                                    <button class="ui button"><a href="{{url('admin/challenge/create' .$challenge->id . '/edit')}}" class="btn btn-default">Edit</a></button>
                                </td>
                                <td></td>
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