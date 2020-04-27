<table class="ui table">
    <thead>
        <tr>
            <th>#</th>
            <th>Challenge Name</th>
            <th>Total Solve</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <?php $cont = 1 ?>
        @foreach ($data as $row)
        <tr>
            <td>{{$cont++}}</td>
            <td>
                <a href="{{url('/competition/'. $competition->id. '/challenge/'. $challenge->id)}}">
                    {{$row->name}}
                </a>
            </td>
            <td>{{count($row->getSolver($competition))}}</td>
            <td>{{$row->pivot->points}}</td>
        </tr>
        @endforeach
    </tbody>
</table>