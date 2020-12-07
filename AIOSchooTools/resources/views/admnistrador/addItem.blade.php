@extends('admnistrador.layout.app')


@section('content')
    <div class="container">
        <form method="post" action="{{ route('insert_material') }}" enctype="multipart/form-data" class="w-75 d-block mx-auto">
            @csrf
            <div class="card bg-light mb-3">
                <div class="card-header">
                    Nome
                    <input id="newmaterial_name" name="newmaterial_name" class="form-control" type="text" />
                </div>
                <div class="card-body">
                    <div class="row ml-2">
                        Descrição
                        <input id="newmaterial_description" name="newmaterial_description" class="form-control mr-2" type="text"/>
                    </div>
                    <hr>
                    <div class="row ml-2">
                        Quantidade disponivel
                        <input id="newmaterial_amount" name="newmaterial_amount" class="form-control mr-2" type="number" min="0"/>
                    </div>
                    <hr>
                    <label class="ml-2"><b> Categoria </b></label>
                    <div class="row row-cols-4 ml-2">
                        @foreach($categories as $category)
                            <div class="col">
                                <label for="{{$category}}radiobtn">{{strtoupper($category[0]).substr($category,1)}}</label>
                                <input id="{{$category}}radiobtn" name="categoryselect[]" value="{{$category}}" type="radio" aria-label="Radio button for following text input">
                            </div>
                        @endforeach
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input id="newcategory" type="radio" name="categoryselect[]" value="newcategory" aria-label="Radio button for following text input">
                                </div>
                            </div>
                            <input id="newcategoryinput" name="newcategoryinput" disabled type="text" class="form-control" placeholder="Nova Categoria" value="">
                        </div>
                    </div>
                    <hr>
                    <div class="row ml-2">
                        Localização
                        <input id="newmaterial_location" name="newmaterial_location" class="form-control mr-2" type="text"/>
                    </div>
                    <hr>
                    <br/>
                    <div class="row ml-2">
                        Carregar imagem
                    </div>
                    <input id="newmaterial_image" name="newmaterial_image" type="file" class="btn btn-dark ml-2">
                    <img id="image_preview" alt="Your image" class="invisible"/>
                    <br/>
                    <button class="btn btn-primary mt-3 d-block mx-auto" type="submit" value="submit">
                        Atualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
