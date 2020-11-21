@extends('aluno.layout.app')

@section('content')
    @foreach($requestedItems as $item)
        @foreach($item as $i)
            {{$i}}
        @endforeach
    @endforeach
@endsection
