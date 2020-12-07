@extends('aluno.layout.app')

@section('content')
    <div class="container">
        <div class="jumbotron alert-success" style="color: black">
            <h2 class="display-4">Requisição efetuada com sucesso!</h2>
            <hr class="my-4">
            <div class="row">
                <div class="col-6">
                    <h3><b>Detalhes:</b></h3>
                    <div class="mt-3 ml-3 p-1">
                        <h5><b>Data:</b></h5>
                        <h5 class="ml-3"> {{ $room_date }} das {{ $starting_hour }}:30 até às {{ $finish_hour }}:30 </h5>
                        <h5><b>Nome:</b></h5>
                        <h5 class="ml-3"> Sala {{ $room_given }} </h5>
                        <h5><b>Localização:</b></h5>
                        <h5 class="ml-3"> {{ $room_location }} </h5>
                    </div>
                </div>
                <div class="col-2">
                    <img width="250px" src="https://icon-library.com/images/success-icon-png/success-icon-png-8.jpg">
                </div>
            </div>
        </div>
    </div>
@endsection
