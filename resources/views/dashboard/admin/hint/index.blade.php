@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="row">
        <div class="col-md-12">

            <div class="ui panel panel-default">
                <div class="ui header">All Hint</div>
                <div class="panel-body">
                    <table class="ui table table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Challenge Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hints as $hint)
                            <tr>
                                <td>{{ $hint->id }}</td>
                                <td>{{ $hint->name }}</td>
                                <td>{{ $hint->description }}</td>
                                <td>{{ $hint->name_chal}}</td>
                                <td>
                                    <form action="{{ url('/admin/hint/' . $hint->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">Remove</button>
                                    </form><br>
                                    <button class="ui button"><a href="{{url('admin/hint/create' .$hint->id . '/edit')}}" class="btn btn-default">Edit</a></button>
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