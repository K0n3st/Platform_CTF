@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="ui container">
    <div class="row">
        <div class="col-md-12">

            <div class="ui panel panel-default">
                <div class="ui header">All categories</div>
                <div class="panel-body">
                    <table class="ui table table-condensed">
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
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <form action="{{ url('/admin/category/' . $category->id. '/delete') }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="ui button red" type="submit">remove</button>
                                    </form>
                                    <a href="{{ url('/admin/category/' . $category->id . '/edit') }}" class="ui button">edit</a>
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