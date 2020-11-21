@extends('aluno.layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <img src="{{$material['image']}}" alt="item"/>
            </div>
            <div class="col">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{$material['name']}}</div>
                    <div class="card-body">
                        <p class="card-text">{{$material['description']}}</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <form id="rentproductform" name="rentproductform" method="post" action="{{ route('item_finish',$material['id'])}}">
                            @csrf
                            <label for="itemAmount">Quantidade: </label>
                            <select id="itemAmount" name="itemAmount" class="custom-select-sm ml-1">
                                @for($i = 1; $i<=$material['amount'];$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <button class="btn btn-primary mt-1 ml-3" type="submit" value="submit">
                                Requisitar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
