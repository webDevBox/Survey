<table>
    <thead>
        {{-- dd($data) --}}
    </thead>
    <tbody>
        <tr>
            <td><strong>Survey: {{ $data['survey']['name'] }}</strong></td>
        </tr>
        <tr></tr>
        <tr>
            @php $questionIds = $data['survey']->questions()->pluck('id')->toArray(); @endphp
            <td><strong>Q{{ array_search($data['question']['id'], $questionIds) + 1 }}. {{$data['question']['question']}}</strong></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td><strong>Breakdown</strong></td>
        </tr>
        <tr>
            <td rowspan="2"><strong>Date</strong></td>
            <!-- <td rowspan="2"><strong>Responses</strong></td> -->
            <td colspan="10"><strong>Breakdown</strong></td>
        </tr>
        
        @foreach($data['breakdown'] as $date => $brkdownArr)
            <tr>
            @foreach($brkdownArr as $brkdown)
                <td><strong>{{$brkdown['label']}}</strong></td>
            @endforeach
            </tr>
            @break
        @endforeach
        @foreach($data['breakdown'] as $date => $brkdownArr)
            <tr>
                <td width="22">{{ parse_by_format($date, "l, F j, Y") }}</td>
                <!-- <td width="15">{{-- $data['overallResponses'] --}}</td> -->
                @foreach($brkdownArr as $brkdown)
                    <td>{{$brkdown['totalResponse']}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>