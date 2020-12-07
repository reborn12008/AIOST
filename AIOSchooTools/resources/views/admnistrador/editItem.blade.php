@extends('admnistrador.layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <img src="{{$material['image']}}" alt="item" class="shopImagePage"/>
            </div>
            <form method="post" action="{{ route('update_item',$material['id']) }}" enctype="multipart/form-data" class="w-50">
            @csrf
            <div class="col p-1">
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        Nome
                        <input id="material_name_input" name="material_name_input" class="form-control" type="text" value="{{ $material['name'] }}" />
                    </div>
                    <div class="card-body">
                        <div class="row ml-2">
                            Descrição
                            <input id="material_description_input" name="material_description_input" class="form-control mr-2" type="text" value="{{ $material['description'] }}"/>
                        </div>
                        <hr>
                        <div class="row ml-2">
                            Quantidade disponivel
                            <input id="material_amount_input" name="material_amount_input" class="form-control mr-2" type="number" min="0" value="{{ $material['amount'] }}"/>
                        </div>
                        <hr>
                        <div class="row ml-2">
                            <label class="p-1"><b> Categoria </b></label>
                            <div class="row row-cols-3">
                            @foreach($categories as $category)
                                <div class="col">
                                    <label for="{{$category}}material_category_input">{{strtoupper($category[0]).substr($category,1)}}</label>
                                    <input id="{{$category}}material_category_input" name="material_category_input[]" value="{{$category}}" type="radio" aria-label="Radio button for following text input"
                                    @if(strtoupper($category[0]).substr($category,1) == strtoupper($material['category'][0]).substr($material['category'],1))checked @endif>
                                </div>
                            @endforeach
                                <div class="input-group ml-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input id="neweditcategory" type="radio" name="material_category_input[]" value="neweditcategory" aria-label="Radio button for following text input">
                                        </div>
                                    </div>
                                    <input id="neweditcategoryinput" name="neweditcategoryinput" disabled type="text" class="form-control" placeholder="Nova Categoria" value="">
                                </div>
                            </div>
                            {{--<input id="material_category_input" name="material_category_input" class="form-control mr-2" type="text" value="{{ $material['category'] }}"/>--}}
                        </div>
                        <hr>
                        <div class="row ml-2">
                            Localização
                            <input id="material_location_input" name="material_location_input" class="form-control mr-2" type="text" value="{{ $material['location'] }}"/>
                        </div>
                        <hr>
                        <div class="row ml-2">
                                Imagem: {{$material['image']}}
                        </div>
                        <br/>
                        <div class="row ml-2">
                            Carregar nova imagem
                        </div>
                        <input id="material_image_input" name="material_image_input" type="file" class="btn btn-dark ml-2">
                        <img id="edit_image_preview" alt="Your image" class="invisible"/>
                        <br/>
                        <button class="btn btn-primary mt-3 d-block mx-auto" type="submit" value="submit">
                            Atualizar
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
