<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Room;
use DB;
use Illuminate\Support\Facades\Validator;
class RoomController extends Controller
{
    public function index(){
    	$rooms=Room::all();
    	return view('fronted.rooms')->with('rooms',$rooms);
    }
    public function Booking($id){
    	$room=Room::find($id);
    	return view('fronted.book_now')->with('room',$room);
    }
     public function Details($id){
    	$room=Room::find($id);
    	return view('fronted.details')->with('room',$room);
    }
    public function checkAvailableRoom (Request $request){
    	    	$this->validate($request,[
    		'check_in_date'=>'required',
            'check_out_date'=>'required',
            'room_type'=>'required',
        ]);
    	        $bookings=DB::table('bookings')
        ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
        ->where(['rooms.room_type'=>$request->room_type])
        ->whereBetween('check_in_date',[$request->check_in_date,$request->check_out_date])
        ->whereBetween('check_out_date',[$request->check_in_date,$request->check_out_date])
        ->get();
        if($bookings->count()>0){
            foreach ($bookings as $key => $data) {
               $models = Room::whereNotIn('id', [$data->room_id])
               ->where('room_type',$request->room_type)
               ->get();
            }
            return view('fronted.check_room')->with([
            	'rooms'=>$models,
            	'check_in_date'=>$request->check_in_date,
            	'check_out_date'=>$request->check_out_date,
        ]);
        // }
            
        }
        else{
            $models=Room::where('room_type',$request->room_type)->get();
             return view('fronted.check_room')->with([
            	'rooms'=>$models,
            	'check_in_date'=>$request->check_in_date,
            	'check_out_date'=>$request->check_out_date,
        ]);
        }
    }
}
