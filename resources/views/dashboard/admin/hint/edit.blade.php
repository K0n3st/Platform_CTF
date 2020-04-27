@extends('layouts.app')

@section('content')
<br><br><br>
<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui red header">
            <div class="content">
                Edit Hint
            </div>
        </h2>
        <div class="ui red segment">
            <form action="{{ url('/admin/hint/'.$hint->id) }}"  method="POST" class="ui form">
                @csrf
                {{ method_field('PUT') }}

                <div class="field">
                    <label  class="control-label">Name</label>
                    <select class="form-control" name="name" value="{{$hint->id}}">
                        @if($hint->name == 'Pista 1')
                            <option selected>Pista 1</option>
                            <option>Pista 2</option>
                            <option>Pista 3</option>
                        @elseif($hint->name == 'Pista 2')
                            <option>Pista 1</option>
                            <option selected>Pista 2</option>
                            <option>Pista 3</option>
                        @elseif($hint->name == 'Pista 3')
                            <option>Pista 1</option>
                            <option>Pista 2</option>
                            <option selected>Pista 3</option>
                        @endif
                    </select>
                </div>


                <div class="field">
                    <label for="" class="control-label">Description</label>
                    <textarea name="description" cols="30" rows="10" class="form-control" required>{{$hint->description}}</textarea>
                </div>

                <div class="field">
                    <label  class="control-label">Challenge</label>
                    <select class="form-control" name="challenge_id"€>
                        @foreach($challenges as $challenge)
                            @if($challenge->id == $hint->challenge_id)
                                <option value="{{$challenge->id}}" selected>{{$challenge->name}}</option>
                            @else
                                <option value="{{$challenge->id}}">{{$challenge->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="ui button blue">
                            <i class="fa fa-plus"></i>  Edit
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