@extends('aluno.layout.app')

@section('content')
    <div class="container">
        <div class="jumbotron alert-success" style="color: black">
            <div class="row">
                <div class="col">
                    <h3 class="display-4">Requisição efetuada com sucesso!</h3>
                </div>
                <div class="col-2">
                    <img width="50px" src="https://icon-library.com/images/success-icon-png/success-icon-png-8.jpg">
                </div>
            </div>
            <hr class="my-4">
            <h4><b>Lista de items:</b></h4>
            <div class="mt-3 ml-3 p-1">
                <ul class="list-group" style="background-color: #b9edd1">
                @foreach($items_list as $it)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <img src="{{$it['image']}}" alt="product_image" class="w-25">
                        <div>
                            {{$it['name']}} - {{$it['description']}}<br/>
                            Local - {{$it['location']}}
                        </div>
                        <span class="badge badge-primary badge-pill mr-5">{{$it['amount']}} item(s)</span>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="ml-4 mt-3">
                <p class="lead">Foi enviado um comprovativo para o seu e-mail que deverá mostrar no ato de recolha dos items.</p>
            </div>
        </div>
    </div>
@endsection
