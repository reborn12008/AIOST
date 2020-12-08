@extends('admnistrador.layout.app')

@section('content')
    <div class="container">
        @if(isset($sucess))
            <div class="alert alert-success" role="alert">
                {{$sucess}}
            </div>
        @endif
        <h1>Materias para requisição</h1>
        <div class="row">
            <div class="col form-group">
                <input id="search_query" name="search_query" placeholder="Pesquisar item" class="form-control" type="text" value="">
            </div>
            <div class="col">
                <a href="{{route('add_item_page')}}" class="btn btn-info">Adicionar produto</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row row-cols-3" id="items_list">
                    @foreach($materialsList as $material)
                        <div class="col">
                            <div class="card mt-2">
                                <img class="shopImage" src="{{$material['image']}}" alt="product"/>
                                <div class="card-body">
                                    <h5 class="card-title"> {{$material['name']}} </h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Quantidade: {{$material['amount']}}</li>
                                    <li class="list-group-item">Categoria: {{strtoupper($material['category'][0]).substr($material['category'],1)}}</li>
                                    <li class="list-group-item"><a href="{{route('edit_item',$material['id'])}}" class="btn btn-primary">Editar</a></li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
