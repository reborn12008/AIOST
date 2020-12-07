@extends('docente.layout.app')

@section('content')
    <div class="container">
        <div class="row ml-5">
            <form method="post" action="{{route('roommap')}}" class="form-row align-items-center">
                @csrf
                <div class="col-auto">
                    <select id="buildingOption" name="buildingOption" class="form-control">
                        @if(!isset($buildingSelect))
                            <option disabled selected> -- Edificio -- </option>
                        @endif
                        @foreach($buildings as $b)
                            <option value="{{$b}}"> {{$b}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select id="typeOption" name="typeOption" class="form-control">
                        @if(!isset($typeSelect))
                            <option disabled selected> -- Tipo de Sala -- </option>
                        @endif
                        @foreach($types as $t)
                            <option value="{{$t}}"> {{$t}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <input id="datemapOption" name="datemapOption" type="date" class="form-control" value="{{$today}}"/>
                </div>
                <div class="col">
                    <button class="btn btn-light border-dark" type="submit">
                        Ver
                    </button>
                </div>
            </form>
        </div>
        {{$roomMapErr ?? '' }}
        <div class="row">
            <div class="col-1 mt-3">
                <button class="btn h-100">
                    <span class="badge badge-pill badge-dark"><h2 class="p-1"> - </h2></span>
                </button>
            </div>
            <div class="col w-75">
                @yield('map')
            </div>
            <div class="col-1 mt-3">
                <button class="btn h-100">
                    <span class="badge badge-pill badge-dark"><h2 class="p-1"> + </h2></span>
                </button>
            </div>
        </div>
    </div>
@endsection




