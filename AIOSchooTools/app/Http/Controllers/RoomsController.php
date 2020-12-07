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
    function __construct() {
        $this->middleware('auth');
        $this->middleware('class');

        $ifTablesExist = Timetable::where([
            ['date','=',date("Y-m-d")]
        ])->count();

        if($ifTablesExist== 0){
            $places = Place::all();
            foreach ($places as $p){
                for($k = 8;$k<10;$k++){
                    $newtimetable= new Timetable();
                    $newtimetable->place_id = $p['id'];
                    $newtimetable->date = date("Y-m-d");
                    $newtimetable->starting_hour ="0" . $k . ":30";
                    $newtimetable->finish_hour = "0" . ($k+1) . ":30";
                    $newtimetable->save();
                }
                for($k = 10;$k<23;$k++){
                    $newtimetable= new Timetable();
                    $newtimetable->place_id = $p['id'];
                    $newtimetable->date = date("Y-m-d");
                    $newtimetable->starting_hour = $k . ":30";
                    $newtimetable->finish_hour = ($k+1) . ":30";
                    $newtimetable->save();
                }

            }

        }
    }

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

        $categories = array();
        $placesCats = Place::all();

        foreach ($placesCats as $p){
            if(!in_array($p['type'],$categories)){
                array_push($categories,$p['type']);
            }
        }

        $dateSelected = $r->request_date;
        $capacitySelected = $r->seats_needed;
        $typeSelected = $r->type_room;
        $starthourSelected = $r->start_hour_room;
        $endhourSelected = $r->end_hour_room;

        $starthourSelected = (explode(':',$starthourSelected))[0];
        $endhourSelected = (explode(':',$endhourSelected))[0];

        $fullHoursCheck = array();

        $place = Place::where([
            ['type', '=', $typeSelected],
            ['capacity', '>=', $capacitySelected],
        ])->orderBy('capacity','asc')->get();

        foreach ($place as $p){
            for($i = $starthourSelected; $i<$endhourSelected; $i++){
                $starthourformat = ($i) . ":30:00";
                $endhourformat = ($i+1) . ":30:00";

                $timetables = Timetable::where([
                    ['date','=',$dateSelected],
                    ['starting_hour', '=', $starthourformat],
                    ['finish_hour', '=', $endhourformat],
                    ['place_id', '=', $p['id']]
                ])->get();

                if(count($timetables) == 0){
                    break;
                }
                $timetables = $timetables[0];

                if( UserTimetable::where('timetable_id','=',$timetables['id'])->count() >= 1 ){
                    $fullHoursCheck = array();
                    break;
                }else{
                    array_push($fullHoursCheck,$timetables['id']);
                }
            }

            if(count($fullHoursCheck) >= ($endhourSelected - $starthourSelected)){
                foreach ($fullHoursCheck as $tt_block){
                    $user_timetable_object = new UserTimetable();
                    $user_timetable_object->timetable_id = $tt_block;
                    $user_timetable_object->user_id = $userId;
                    $user_timetable_object->save();
                }
                return view('aluno.roomGiven',[
                    'user'=>$userclass,
                    'username'=>$user['name'],
                    'room_given'=>$p['name'],
                    'room_location'=>$p['location'],
                    'starting_hour'=>$starthourSelected,
                    'finish_hour'=>$endhourSelected,
                    'room_date'=>$dateSelected
                ]);
            }
        }
        return view('aluno.roomForm',[
            'user'=>$userclass,
            'username'=>$user['name'],
            'roomTypes'=>$categories,
            'roomNotFound'=>'Não foi possivel encontrar um espaço com os parametros especificados!'
        ]);
    }

    public function roomsmap(){
        $user = Auth::user();
        $userId = $user['id'];

        $userclass = Profile::findOrFail($userId);
        $userclass = $userclass['roleClass'];

        $today = date('yy:m:d h:m:s');
        $today = substr($today,0,10);
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
                $checkIfOcc = UserTimetable::where('timetable_id', $tt['id'])->get();
                if($checkIfOcc->count()>0){
                    $checkIfOcc = $checkIfOcc[0];
                    $user = User::findOrFail($checkIfOcc['user_id']);
                    $tt['userInRoom'] = $user['name'];
                }
                $tt['place_id'] = $p['name'];
                array_push($finalTimeTable,$tt);
            }
        }

        $finalTimeTable = array_chunk($finalTimeTable,15);

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
