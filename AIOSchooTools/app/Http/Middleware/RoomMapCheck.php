<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoomMapCheck
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
        $buildingSelected = $request->input('buildingOption');
        $roomTypeSelected = $request->input('typeOption');
        $roomMapErr = "";

        if($buildingSelected == null || $roomTypeSelected == null){
            $roomMapErr = "Todos os campos devem ser preenchidos!!";
            return back()->with('roomMapErr',$roomMapErr);
        }
        return $next($request);
    }
}
