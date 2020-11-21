<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    public function index(){
        //faz qer dosproduts dsponivis
        $materialsOptions =array();
        $categories = array();
        $materialsList = Material::all();
        foreach ($materialsList as $material){
            if($material['amount']>0){
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

        

        return view('aluno.cartEnd',['user'=>$userclass,'username'=>$user['name'], 'requestedItems'=>$materials]);
    }
}
