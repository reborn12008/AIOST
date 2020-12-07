<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Profile;
use App\Models\Request_Material;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    function __construct() {
        $this->middleware('auth');
        $this->middleware('class');
        //TODO Middlewares
    }

    public function index(){
        //faz qer dosproduts dsponivis
        $materialsOptions =array();
        $categories = array();
        $materialsList = Material::all();
        foreach ($materialsList as $material){
            if($material['amount']>0){
                array_push($materialsOptions,$material);
            }

            if(!in_array($material['category'],$categories)){
                array_push($categories,$material['category']);
            }
        }
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];
        return view('aluno.shop',['user'=>$userclass,'username'=>$user['name'], 'materialsList'=>$materialsOptions, 'categories'=>$categories]);
    }

    public function filterCategory($category){
        $materialsOptions =array();
        $categories = array();
//        $materialsList = Material::all()->where('category',$category);
        $materialsList = Material::all();
        foreach ($materialsList as $material){
            if($material['amount']>0 && $material['category'] == $category){
                array_push($materialsOptions,$material);
            }
            if(in_array($material['category'],$categories)){

            }else{
                array_push($categories,$material['category']);
            }
        }
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];
        return view('aluno.shop',['user'=>$userclass,'username'=>$user['name'], 'materialsList'=>$materialsOptions, 'categories'=>$categories]);
    }

    public function item($material){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $material = Material::findorFail($material);

        return view('aluno.item',['user'=>$userclass,'username'=>$user['name'], 'material'=>$material]);
    }

    public function storeItem(Request $r,$product){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $material = Material::findOrFail($product);

        $localCache = Cache::pull('cart');
        $amount = $r->itemAmount;
        $material['amount'] = $amount;


        $cart = array();
        if($localCache == null){
            array_push($cart,$material);
        }else{
            foreach ($localCache as $item){
                array_push($cart,$item);
            }
            array_push($cart,$material);
        }

        Cache::add('cart',$cart);

        return view('aluno.itemFinish',['user'=>$userclass,'username'=>$user['name'],'product'=>$material['name'], 'amount'=>$amount]);
    }

    public function confirm_request(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $items = Cache::get('cart');

        return view('aluno.cart',['user'=>$userclass,'username'=>$user['name'], 'items'=>$items]);
    }

    public function delete_cart(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        Cache::pull('cart');
        return view('aluno.home',['user'=>$userclass,'username'=>$user['name']]);
    }

    public function confirm_cart(Request $r){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $cart = Cache::pull('cart');

        $materials = array();

        foreach ($cart as $c){
            $itemname = $c['id'] . "amount";
            $c['amount'] = $r->$itemname;
            $m = Material::findOrFail($c['id']);
            if($c['amount']>$m['amount']){
                return 'Error';
            } else {
                $material = array($c['id'],$c['amount']);
                array_push($materials,$material);
            }
        }

        $newrequestId = count(Requests::all()) + 1;
        $newrequest = new Requests;
        $newrequest->id = $newrequestId;
        $newrequest->user_id = $userId;
        $newrequest->request_date = date('Y-m-d H:i:s');
        $newrequest->save();

        foreach ($materials as $m){
            $newrequestmaterial = new Request_Material();
            $newrequestmaterial->request_id = $newrequestId;
            $newrequestmaterial->material_id = $m[0];
            $newrequestmaterial->material_amount = $m[1];
            $newrequestmaterial->save();

            $decreaseMaterialAmount = Material::findOrFail($m[0]);
            $currentAmount = $decreaseMaterialAmount['amount'];
            $newAmount = $currentAmount - $m[1];
            $decreaseMaterialAmount->update(['amount'=> $newAmount]);
        }


        return view('aluno.cartEnd',['user'=>$userclass,'username'=>$user['name'],'items_list'=>$cart]);
    }

    public function stock_page(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $materialsList = Material::all();

        return view('admnistrador.stock', ['user'=>$userclass,'username'=>$user['name'], 'materialsList' =>$materialsList]);
    }

    public function edit_item($item){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $materialToEdit = Material::find($item);

        $categories = array();
        $materialsList = Material::all();
        foreach ($materialsList as $material){
            if(!in_array($material['category'],$categories)){
                array_push($categories,$material['category']);
            }
        }

        return view('admnistrador.editItem', [
            'user'=>$userclass,
            'username'=>$user['name'],
            'material' =>$materialToEdit,
            'categories'=>$categories
            ]);
    }

    public function update_item(Request $r, $item){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $materialToEdit = Material::find($item);

        $material_name_input = $r->material_name_input;
        $material_description_input = $r->material_description_input;
        $material_amount_input = $r->material_amount_input;
        $material_category_input = $r->input('material_category_input');
        $material_category_input = $material_category_input[0];
        if($material_category_input == "neweditcategory"){
            $material_category_input = $r->input("neweditcategoryinput");
        }
        $material_location_input = $r->material_location_input;

        if ($r->hasFile('material_image_input')) {
            $image = $r->file('material_image_input');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images') , $imageName);

            $materialToEdit->image = '/images/' . $imageName;
        }

        $materialToEdit->name = $material_name_input;
        $materialToEdit->description = $material_description_input;
        $materialToEdit->amount = $material_amount_input;
        $materialToEdit->category = $material_category_input;
        $materialToEdit->location = $material_location_input;
        $materialToEdit->save();

        $categories = array();
        $materialsList = Material::all();
        foreach ($materialsList as $material){
            if(!in_array($material['category'],$categories)){
                array_push($categories,$material['category']);
            }
        }

        return view('admnistrador.editItem', [
            'user'=>$userclass,
            'username'=>$user['name'],
            'material' =>$materialToEdit,
            'categories'=>$categories,
            ]);
    }

    public function create_material_page(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $categories = array();
        $materialsList = Material::all();
        foreach ($materialsList as $material){
            if(!in_array($material['category'],$categories)){
                array_push($categories,$material['category']);
            }
        }

        return view('admnistrador.addItem', ['user'=>$userclass,'username'=>$user['name'], 'categories'=>$categories]);
    }

    public function insert_material(Request $r){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $new_material_name = $r->input('newmaterial_name');
        $new_material_description = $r->input('newmaterial_description');
        $new_material_amount = $r->input('newmaterial_amount');
        $new_material_category = $r->input('categoryselect');
        $new_material_category = $new_material_category[0];
        if($new_material_category == "newcategory" ){
            $new_material_category = $r->input('newcategoryinput');
        }
        $new_material_location = $r->input('newmaterial_location');

        if ($r->hasFile('newmaterial_image')) {
            $image = $r->file('newmaterial_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images') , $imageName);
        }

        $new_material = new Material();
        $new_material->name = $new_material_name;
        $new_material->description = $new_material_description;
        $new_material->amount = $new_material_amount;
        $new_material->category = $new_material_category;
        $new_material->image = '/images/' . $imageName;
        $new_material->location = $new_material_location;
        $new_material->save();

        return view('admnistrador.stock', [
            'user'=>$userclass,
            'username'=>$user['name'],
            'materialsList' => Material::all(),
            'sucess'=>'Novo item adicionado com sucesso!']);
    }
}
