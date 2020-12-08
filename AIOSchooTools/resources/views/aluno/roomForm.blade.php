@extends('aluno.layout.app')
@section('content')
    <div class="container">
        <h1>FORMULARIO</h1>
        <div class="row">
            <div class="col-8">
                <form method="post" action="{{route('room_given')}}" class="ml-5 mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="request_date">Data:</label>
                        <div class="form-row align-items-center ml-2">
                            <input id="request_date" name="request_date" type="date" class="form-control w-25 mr-2"/>
                            <span>*A data para a qual pretende requisitar a sala</span><br/>
                        </div>
                        <span class="ml-3 mt-2" style="color: red;"><b>{{session('dateErr') ?? ''}}</b></span>
                        <br/>
                        <label for="seats_needed">Lotação necessária:</label>
                        <div class="form-row align-items-center ml-2">
                            <input id="seats_needed" name="seats_needed" type="number" class="form-control w-25 mr-2"
                                   min="0"/>
                            <span>*Para quantas pessoas é a sala</span>
                        </div>
                        <span class="ml-3 mt-2" style="color: red;"><b>{{session('seatsErr') ?? ''}}</b></span>
                        <br/>
                        <label for="type_room">Tipo de sala:</label>
                        <div class="form-row align-items-center ml-2">
                            <select id="type_room" name="type_room" class="form-control w-25 mr-2">
                                <option disabled selected></option>
                                @foreach($roomTypes as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                            <span>*Tipo de sala que pretende</span>
                            <br/>
                        </div>
                        <span class="ml-3 mt-2" style="color: red;"><b>{{session('typeErr') ?? ''}}</b></span>
                        <br/>
                    </div>
                    <div class="form-group">
                        <label for="start_hour_room">Quando irá utilizar a sala:</label>
                        <div class="form-row ml-2">
                            <div class="col-2">
                                <select id="start_hour_room" name="start_hour_room" class="form-control">
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
                                </select>
                            </div>
                            <div class="col-2">
                                <select id="end_hour_room" name="end_hour_room" class="form-control">
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
                            </div>
                            <div class="col mt-1">
                                <span>*O horário que pretende</span><br>
                            </div>
                        </div>
                        <span class="ml-3 mt-2" style="color: red;"><b>{{session('hoursErr') ?? ''}}</b></span>
                    </div>
                    <div class="form-group">
                        <div class="form-row justify-content-center">
                            <button type="submit" class="btn btn-info">Encontrar sala</button>
                        </div>
                    </div>
                </form>
            </div>
            @if(isset($roomNotFound))
                <div class="col-3 mt-5">
                    <div class="card border-danger">
                        <div class="card-header border-danger" style="background-color: #ff5e5e">
                            <b>Resultados não encontrados</b>
                        </div>
                        <div class="card-body">
                            {{ $roomNotFound }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
