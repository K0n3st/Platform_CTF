extends@('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1><br>

    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Challenge Name</th>
                        <th>Solver By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category->challenges as $challenge)
                    <tr>
                        <td>{{ $challenge->id }}</td>
                        <td>{{ $challenge->name}}</td>
                        <td>0</td>
                        <td><a href="{{ url('challenge/'. $challenge->id) }}" class="btn btn-default">Solver</a></td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection