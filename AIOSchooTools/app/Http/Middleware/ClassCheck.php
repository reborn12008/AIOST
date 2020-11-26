<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ClassCheck
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
       $xyzpath = $request->path();

       $user = $request->user();
       $user = $user['id'];

       $userclass = Profile::findOrFail($user);

        $routes = Route::getRoutes();
        foreach($routes as $r){
            if($r->uri == $xyzpath){
                if(str_contains($xyzpath, $userclass) ){
                    return $next($request);
                }else{
                    return 404;
                }
            }
        }
        return 404;
    }
}
