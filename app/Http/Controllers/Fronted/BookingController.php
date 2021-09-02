<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Booking;
use App\Models\Admin\Room;
use Auth;
use DB;
class BookingController extends Controller
{
    public function checkAvail($id,Request $request){

        $booking=Booking::where('room_id',$id)
            ->where(function($query) use($request){
                //$query->where('check_out_date','>',$request->check_in_date);
                $query->whereBetween('check_in_date',[$request->check_in_date,$request->check_out_date])
                ->whereBetween('check_out_date',[$request->check_in_date,$request->check_out_date]);
            })
            ->get();
        if($booking->count()>0){
            
                return response()->json(['success'=>'Room already Booked']); 
    }
    return response()->json(['success'=>'Room is available for booking.']);
        }

    public function store($id,Request $request){
    	$this->validate($request,[
    		'c_in_date'=>'required',
            'c_out_date'=>'required',
            'c_guest'=>'required',
            'c_room_type'=>'required',
        ]);

            $room=Room::find($id);

            $booking=Booking::where('room_id',$room->id)
            ->where(function($query) use($request){
                //$query->where('check_out_date','>',$request->c_in_date);
                $query->whereBetween('check_in_date',[$request->c_in_date,$request->c_out_date])
                ->whereBetween('check_out_date',[$request->c_in_date,$request->c_out_date]);
            })
            ->get();
            if(!$request->user()->hasVerifiedEmail()){
                return view('auth.verify');
            }
            if($booking->count()>0){
                    return redirect()->route('room.book_now',$id)->with('warning','Room already Booked'); 
                
            }
            
            $room_id=$room->id;
            $room->available='0';
            $room->save();
            $book_now=Booking::create([
                'user_id'=>auth()->user()->id,
                'room_id'=>$room_id,
                'check_in_date'=>$request->c_in_date,
                'check_out_date'=>$request->c_out_date,
                'num_of_guest'=>$request->c_guest,
                'room_type'=>$request->c_room_type,
                'status'=>'Pending',
            ]);
            if($book_now){
                return redirect()->route('room.book_now',$id)->with('success','Successfully Request for booking. Hotel Manager will be contact with you very Soon. Thank You Using Our services.');
            }
        }

         public function BookNow(Request $request){
        $this->validate($request,[
            'check_in_date'=>'required',
            'check_out_date'=>'required',
            'guest'=>'required',
            'room_type'=>'required',
        ]);

            $room=Room::where('id',$request->bid)->first();
            $booking=Booking::where('room_id',$room->id)
            ->where(function($query) use($request){
                //$query->where('check_out_date','>',$request->check_in_date);
                $query->whereBetween('check_in_date',[$request->check_in_date,$request->check_out_date])
                ->whereBetween('check_out_date',[$request->check_in_date,$request->check_out_date]);
            })
            ->get();
            if(!$request->user()->hasVerifiedEmail()){
                return view('auth.verify');
            }
            if($booking->count()>0){
                    return redirect()->route('rooms')->with('warning','Room already Booked'); 
                
            }
            

            $room_id=$room->id;
            $room->available='0';
            $room->save();
            $book_now=Booking::create([
                'user_id'=>auth()->user()->id,
                'room_id'=>$room_id,
                'check_in_date'=>$request->check_in_date,
                'check_out_date'=>$request->check_out_date,
                'num_of_guest'=>$request->guest,
                'room_type'=>$request->room_type,
                'status'=>'Pending',
            ]);
            if($book_now){
                return redirect()->route('rooms')->with('success','Successfully Request for booking. Hotel Manager will be contact with you very Soon. Thank You Using Our services.');
            }
        }
}
