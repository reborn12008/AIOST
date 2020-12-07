<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoomFormCheck
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
        $dateInput = $request->input('request_date');
        $seatsInput = $request->input('seats_needed');
        $typeInput = $request->input('type_room');
        $startHourInput = $request->input('start_hour_room');
        $finishHourInput = $request->input('end_hour_room');

        $dateErr = "";
        $seatsErr = "";
        $typeErr = "";
        $hoursErr = "";

        $errCheck = false;

        if($dateInput< date('Y-m-d')){
            $dateErr = "A data tem de ser superior à presente!";
            $errCheck = true;
        }
        if($seatsInput == null || $seatsInput==0){
            $seatsErr = "A lotação necessária tem de ser superior a 0!";
            $errCheck = true;
        }
        if($typeInput == null){
            $typeErr = "Deve selecionar um tipo de sala!";
            $errCheck = true;
        }

        $timepresent = date('H:i');
        if($startHourInput < $timepresent || $finishHourInput < $timepresent){
            $hoursErr = "A hora escolhida deve ser superior à atual!";
            $errCheck = true;
        }

        if($startHourInput > $finishHourInput){
            $hoursErr = "A hora de inicio deve ser superior à hora de fim!";
            $errCheck = true;
        }

        if($errCheck){
//            return back()->with([
//                ['dateErr',$dateErr],
//                ['seatsErr',$seatsErr],
//                ['typeErr',$typeErr],
//                ['hoursErr',$hoursErr]
//            ]);
            return back()->with('dateErr',$dateErr)->with('seatsErr',$seatsErr)->with('typeErr',$typeErr)->with('hoursErr',$hoursErr);
        }
        return $next($request);
    }
}
