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
        $xyzpath = explode("/", $xyzpath);
        $user = $request->user();
        $userclass = Profile::findOrFail($user['id']);
        $userclass = $userclass['roleClass'];
        $routes = Route::getRoutes();

        foreach($routes as $r){
            $linkRole = explode("/", $r->uri);
            if($linkRole[0] == $xyzpath[0] && $linkRole[0] == $userclass){
                return $next($request);
            }
        }
        return redirect()->to(route('home',$userclass));
    }
}
