@extends('docente.roomMap')

@section('map')
    <div class="row">
        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th>09:30</th>
                <th>10:30</th>
                <th>11:30</th>
                <th>12:30</th>
                <th>13:30</th>
                <th>14:30</th>
                <th>15:30</th>
                <th>16:30</th>
                <th>17:30</th>
                <th>18:30</th>
                <th>19:30</th>
                <th>20:30</th>
                <th>21:30</th>
                <th>22:30</th>
            </tr>
            </thead>
            <tbody>
            @foreach($timetable as $tt)
                <tr> <th></th>
                    @foreach($tt as $t)
                        @if(isset($t['userInRoom']))
                            <th class="occupied_timetable" style="background-color: red">
                                {{$t['place_id']}}
                                <div class="occupying_person">
                                    {{$t['userInRoom']}}
                                </div>
                            </th>
                        @else
                            <th>{{$t['place_id']}}</th>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
