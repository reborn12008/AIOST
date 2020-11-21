@extends('aluno.layout.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('confirm_cart')}}">
            @csrf
            <ul class="list-group">
            @foreach($items as $it)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <img src="{{$it['image']}}" alt="product_image" class="w-25">
                        {{$it['name']}} - {{$it['description']}}
                        <span class="badge badge-primary badge-pill mr-5">
                            <input id="amount" name="{{$it['id']}}amount" class="form-control w-50 mx-auto" type="number" value="{{$it['amount']}}"/> itens</span>
                    </li>
            @endforeach
            </ul>
            <a class="btn btn-danger mt-2 mr-2" href="{{route('delete_cart')}}" onclick="return confirm('Are you sure?')">Apagar carrinho</a>
            <button class="btn btn-primary float-right mt-2 ml-2" type="submit">Prosseguir</button>
        </form>
    </div>
@endsection
