<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Profile;
use App\Models\Timetable;
use App\Models\User;
use App\Models\UserTimetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    public function roomform(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $categories = array();

        $places = Place::all();

        foreach ($places as $p){
            if(!in_array($p['type'],$categories)){
                array_push($categories,$p['type']);
            }
        }
        return view('aluno.roomForm',['user'=>$userclass,'username'=>$user['name'],'roomTypes'=>$categories]);
    }

    public function given_room(Request $r){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $dateSelected = $r->request_date;
        $capacitySelected = $r->seats_needed;
        $typeSelected = $r->type_room;

        return view('aluno.roomGiven',['user'=>$userclass,'username'=>$user['name']]);
    }

    public function roomsmap(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $today = date('yy:m:d h:m:s');
        $today =substr($today,0,10);
        $today = str_replace(':','-',$today);

        $buildings = array();
        $roomTypes = array();

        $places = Place::all();

        foreach ($places as $p){
            if(!in_array($p['location'],$buildings)){
                array_push($buildings,$p['location']);
            }
            if(!in_array($p['type'],$roomTypes)){
                array_push($roomTypes,$p['type']);
            }
        }
        return view('docente.roomMap',[
            'user'=>$userclass,
            'username'=>$user['name'],
            'today'=>$today,
            'buildings'=>$buildings,
            'types'=>$roomTypes,
        ]);
    }

    public function map(Request $r){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $buildingSelected = $r->buildingOption;
        $typeSelected = $r->typeOption;
        $datemapSelected = $r->datemapOption;

        $buildings = array();
        $roomTypes = array();

        $places = Place::all();
        array_push($buildings,$buildingSelected);
        array_push($roomTypes,$typeSelected);
        foreach ($places as $p){
            if(!in_array($p['location'],$buildings)){
                array_push($buildings,$p['location']);
            }
            if(!in_array($p['type'],$roomTypes)){
                array_push($roomTypes,$p['type']);
            }
        }
        $finalTimeTable = array();
        $timetable = Timetable::all()->where('date',$datemapSelected);
        foreach ($timetable as $tt){
            $p = Place::findOrFail($tt['place_id']);
            if($p['location']==$buildingSelected && $p['type']==$typeSelected){
                $checkIfOcc = UserTimetable::all()->where('timetable_id', $tt['id']);
                if($checkIfOcc->count()>0){
                    $checkIfOcc = $checkIfOcc[0];
                    $user = User::findOrFail($checkIfOcc['user_id']);
                    $tt['userInRoom'] = $user['name'];
                }
                $tt['place_id'] = $p['name'];
                array_push($finalTimeTable,$tt);
            }
        }

        $finalTimeTable = array_chunk($finalTimeTable,14);

        return view('docente.roomlist',[
            'user'=>$userclass,
            'username'=>$user['name'],
            'today'=>$datemapSelected,
            'buildings'=>$buildings,
            'types'=>$roomTypes,
            'buildingSelect'=>$buildingSelected,
            'typeSelect'=>$typeSelected,
            'timetable'=>$finalTimeTable,
        ]);
    }
}
