@extends('aluno.layout.app')
@section('content')
    <div class="row">
        <div class="col-2">
            <ul class="list-group position-fixed mt-5 ml-1">
                <li class="list-group-item active">
                    <h3>Aplicar Filtros</h3>
                </li>
                @foreach($categories as $category)
                <li class="list-group-item">
                    <div class="form-check">
                        <input class="form-check-input filtercheckbox" type="checkbox" name="checkboxfilter" id="{{$category}}check" value="{{$category}}">
                        <label class="form-check-label" for="inlineRadio1">{{strtoupper($category[0]).substr($category,1)}}</label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <h1>Materias para requisição</h1>
            <div class="row row-cols-3" id="shopItems_list">
                @foreach($materialsList as $material)
                    <div class="col">
                        <div class="card mt-2">
                            <img class="shopImage" src="{{$material['image']}}" alt="product"/>
                            <div class="card-body">
                                <h5 class="card-title"> {{$material['name']}} </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Disponivel: {{$material['amount']}}</li>
                                <li class="list-group-item">Categoria: {{strtoupper($material['category'][0]).substr($material['category'],1)}}</li>
                                <li class="list-group-item"><a href="{{route('shop_item',$material['id'])}}" class="btn btn-primary">Requisitar</a></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
