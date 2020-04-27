@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="row">
        <div class="col-md-12">

            <div class="ui panel panel-default">
                <div class="ui header">All Competition</div>
                <div class="ui panel-body">
                    <table class="ui table table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Active</th>
                                <th>Visible</th>
                                <th>Playmode</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Participants</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($competitions as $competition)
                            <tr>
                                <td>{{ $competition->id }}</td>
                                <td>{{ $competition->name }}</td>
                                <td>{{ $competition->description }}</td>
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
                                <td>{{ $competition->playmode }}</td>
                                <td>{{ $competition->start_date }}</td>
                                <td>{{ $competition->end_date }}</td>
                                <td>{{count($competition->participations)}}</td>
                                <td>
                                    <form action="{{ url('/admin/competition/' . $competition->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">Remove</button>
                                    </form><br>    
                                    <button class="ui button"><a href="{{url('admin/competition/' .$competition->id . '/edit')}}" class="btn btn-default">Edit</a></button>
                                </td>
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