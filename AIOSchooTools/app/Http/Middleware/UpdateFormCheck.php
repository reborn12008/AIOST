<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UpdateFormCheck
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
        $name = $request->input('material_name_input');
        $description = $request->input('material_description_input');
        $amount = $request->input('material_amount_input');
        $category = $request->input('material_category_input');
        $location = $request->input('material_location_input');

        $nameErr = '';
        $descriptionErr = '';
        $amountErr = '';
        $categoryErr = '';
        $locationErr = '';

        $errorCheck = false;

        if($name == null){
            $nameErr = "Este campo não pode estar vazio!";
            $errorCheck = true;
        }
        if($description == null){
            $descriptionErr = "Este campo não pode estar vazio!";
            $errorCheck = true;
        }
        if($amount == null){
            $amountErr = "Este campo não pode estar vazio!";
            $errorCheck = true;
        }
        if($category[0] == "neweditcategory"){
            $category = $request->input('neweditcategoryinput');
            if($category == null){
                $categoryErr = "Este campo não pode estar vazio!";
                $errorCheck = true;
            }
        }
        if($location == null){
        $locationErr = "Este campo não pode estar vazio!";
            $errorCheck = true;
    }

        if($errorCheck){
            return back()->with('nameErr',$nameErr)->with('descriptionErr',$descriptionErr)->with('amountErr',$amountErr)->with('categoryErr',$categoryErr)->with('locationErr',$locationErr);
        }
        return $next($request);
    }
}
