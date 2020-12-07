<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InsertFormCheck
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
        $name = $request->input('newmaterial_name');
        $description = $request->input('newmaterial_description');
        $amount = $request->input('newmaterial_amount');
        $category = $request->input('categoryselect');
        $location = $request->input('newmaterial_location');
        $image = $request->file('newmaterial_image');

        if($name == null || $description == null || $amount == null || $category[0] == null || $location == null || $image == null){
            return back();
        }

        return $next($request);
    }
}
