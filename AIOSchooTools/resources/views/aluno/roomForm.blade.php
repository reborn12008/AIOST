@extends('aluno.layout.app')
@section('content')
<div class="container">
    <h1>FORMULARIO</h1>
    <form method="post" action="{{route('room_given')}}">
        @csrf
        <div class="form-group">
            <label for="request_date">Data:</label>
            <input id="request_date" name="request_date" type="date"/>
            <br/><span>*A data para a qual pretende requisitar a sala</span><br/>

            <label for="seats_needed">Lotação necessária:</label>
            <input id="seats_needed" name="seats_needed" type="number"/>
            <br/><span>*Para quantas pessoas é a sala</span><br/>
        </div>
        <div class="form-group">
            <label for="type_room">Tipo de sala:</label>
            <select id="type_room" name="type_room">
                @foreach($roomTypes as $type)
                    <option>{{$type}}</option>
                @endforeach
            </select>
            <br/><span>*Para quantas pessoas é a sala</span><br/>
        </div>
        <div class="form-group">
            <label for="hour_room">Hora:</label>
            <select id="hour_room" name="hour_room">
                <option>09:30</option>
                <option>10:30</option>
                <option>11:30</option>
                <option>12:30</option>
                <option>13:30</option>
                <option>14:30</option>
                <option>15:30</option>
                <option>16:30</option>
                <option>17:30</option>
                <option>18:30</option>
                <option>19:30</option>
                <option>20:30</option>
                <option>21:30</option>
                <option>22:30</option>
            </select>
            <br/><span>*A que horas necessita</span><br/>
        </div>
    </form>
</div>
@endsection
