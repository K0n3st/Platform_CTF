<table class="ui table">
    <thead>
        <th>#</th>
        <th>Username</th>
        <th>Points</th>
        @if(isset($useLatestSubmit) && $useLatestSubmit)
            <th>Latest Submit</th>
        @endif
    </thead>
    <tbody>
        <?php $cont = 1; ?>
        @foreach($data as $row)
        <tr>
            <td>{{ $cont }}</td>
            @if($competition->playmode == 'team')
                <td>{{$row->nameTeam}}</td>
            @else
                <td>{{$row->username}}</td>
            @endif
            <td>{{$row->points}}</td>
            @if(isset($useLatestSubmit) && $useLatestSubmit)
                @if(isset($row->latest_submit))
                    <td><time title="{{$row->latest_submit}}">{{$row->latest_submit}}</time></td>
                @else
                    <td>-</td>
                @endif
            @endif
        </tr>
        <?php $cont++; ?>
        @endforeach
    </tbody>
</table>