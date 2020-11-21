<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];
        return view('aluno.roomForm',['user'=>$userclass,'username'=>$user['name']]);
    }

    public function roomsmap(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $timetable = Timetable::all();

        $today = date('yy:m:d h:m:s');
        dd($today);
        return view('docente.roomMap',['user'=>$userclass,'username'=>$user['name']]);
    }
}
