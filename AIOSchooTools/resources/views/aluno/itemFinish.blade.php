@extends('aluno.layout.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            <br/>
            {{$amount}} {{$product}}(s) adicionados ao cesto! <br/><br/>
            <a href="{{route('aluno_shop')}}" class="alert-link">
                <img style="width: 10px" src="/images/back_arrow.png">
                Ver mais produtos
            </a>
            <a href="{{route('item_cart')}}" class="alert-link float-right">
                Prosseguir para confirmação
                <img style="width: 10px;" src="/images/forward-arrow.png">
            </a>
        </div>
    </div>

@endsection
