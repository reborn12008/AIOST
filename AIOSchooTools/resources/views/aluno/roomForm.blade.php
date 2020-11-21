@extends('aluno.layout.app')
@section('content')
<div class="container">
    <h1>FORMULARIO</h1>
    <form method="post" action="#">
        @csrf
        <div class="form-group">
            <label for="request_date">Data:</label>
            <input id="request_date" type="date"/>
            <br/><span>*A data para a qual pretende requisitar a sala</span><br/>

            <label for="seats_needed">Lotação necessária:</label>
            <input id="seats_needed" type="number"/>
            <br/><span>*Para quantas pessoas é a sala</span><br/>
        </div>
        <div class="form-group">
            <label for="seats_needed">Lotação necessária:</label>
            <input id="seats_needed" type="number"/>
            <br/><span>*Para quantas pessoas é a sala</span><br/>
        </div>
        <div class="form-group">
            <label for="type_room">Tipo de sala:</label>
            <select id="type_room">
                <option value="audit">Auditório</option>
                <option value="lab">Laboratório</option>
                <option value="room">Sala</option>
            </select>
            <br/><span>*Para quantas pessoas é a sala</span><br/>
        </div>
    </form>
</div>
@endsection
