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

        if($name == null || $description == null || $amount == null || $category[0] == null || $location == null){
            return back();
        }
        return $next($request);
    }
}
