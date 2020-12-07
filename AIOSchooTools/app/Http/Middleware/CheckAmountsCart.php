<?php

namespace App\Http\Middleware;

use App\Models\Material;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CheckAmountsCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = Cache::get('cart');
        $cartErrs = array();
        $errCheck = false;
        foreach ($cart as $c){
            $mat = Material::find($c['id']);
            $err = "";
            if($mat['amount']<$request->input($c['id'] . 'amount')){
                $errCheck = true;
                $err = 'A quantidade escolhida excede o stock disponivel!' . '\n' . 'Stock:' . $mat['amount'];
            }
            array_push($cartErrs,$err);
        }

        if($errCheck == true){
            return redirect()->back()->with('error',$cartErrs);
        }
        return $next($request);
    }
}
