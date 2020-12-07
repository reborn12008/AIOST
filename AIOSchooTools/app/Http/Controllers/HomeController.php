<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user)
    {
        $authUser = Auth::user();
        $authUser = $authUser['name'];
        if($user=="aluno"){
            return view('aluno.home',['user'=>$user,'username'=>$authUser]);
        }else if ($user=="docente"){
            return view('docente.home',['user'=>$user,'username'=>$authUser]);
        }else if($user=="admnistrador"){
            return view('admnistrador.home',['user'=>$user,'username'=>$authUser]);
        }
        return view('home');
    }
}
