@extends('aluno.layout.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            <br/>
            {{$amount}} {{$product}}(s) adicionados ao cesto! <br/><br/>
            <a href="{{route('aluno_shop')}}" class="alert-link">
                <img style="width: 10px" src="https://lh3.googleusercontent.com/proxy/OWrDhdfC_yTuU9cup8XoXRroP1DeO70PWpR_JSNaclgEXlLp4moqE_im6qm_DAdBQExQsOG1n6gI6Vr5tNuLDGcbSeKvyfSIzTSE-Z0BU3l10w3pMrtP2gQKSPvW8l2AGE5uQ3rC7ZfisTSXd0qlw5k">
                Ver mais produtos
            </a>
            <a href="{{route('item_cart')}}" class="alert-link float-right">
                Prosseguir para confirmação
                <img style="width: 10px;" src="https://www.pngrepo.com/download/137755/forward-arrow.png">
            </a>
        </div>
    </div>

@endsection
