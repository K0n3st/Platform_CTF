@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Contest Information</div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/admin/competition/' . $competition->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="" class="control-label">Contest Name</label>
                            <input type="text" class="form-control" name="name" value="{{$competition->name}}">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Category Description</label>
                            <textarea type="text" class="form-control" name="description" rows="10">{{$competition->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i>Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Contest Statistic</div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Participants</td>
                                <td>{{$competition->participations->count()}}</td>
                            </tr>
                            <tr>
                                <td>Total Submission</td>
                                <td>??</td>
                            </tr>
                            <tr>
                                <td>Tasks</td>
                                <td>{{$competition->challenges()->count()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>
                <div class="panel-body">
                    <div class="col-md-6">

                        <form action="{{ url('/admin/competition/' . $competition->id . '/challenge') }}" method="POST" class="form-horizontal">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="challenge-id" placeholder="new challenge id">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="challenge-points" placeholder="points">
                                </div>
                                <div class="col-md-2">
                                    <input class="btn btn-default" type="submit">
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-12">
                        <h3>Added</h3>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>category</th>
                                    <th>title</th>
                                    <th>description</th>
                                    <th>points</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($competition->challenges as $challenge)
                                <tr>
                                    <td>{{$challenge->id}}</td>
                                    <td>{{$challenge->category->name}}</td>
                                    <td>{{$challenge->title}}</td>
                                    <td>{{$challenge->description}}</td>
                                    <td>{{$challenge->pivot->points}}</td>
                                    <td>

                                    <form action="{{ url('/admin/competition/' . $competition->id . '/challenge/' . $challenge->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-default" type="submit">remove</button>
                                    </form>
                                    <a href="{{ url('/admin/challenge/create . $challenge->id . '/edit') }}" class="btn btn-default">edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection