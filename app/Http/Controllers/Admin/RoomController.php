<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Room;


class RoomController extends Controller
{
    public function index(){
      $room=Room::paginate(15);
    	return view('admin.rooms.index')->with('room',$room);
    }
    public function AvailRoom(){
      $room=Room::where('available','1')->paginate(15);
    	return view('admin.rooms.avail')->with('room',$room);
    }
    public function AddRoom(){
    	return view('admin.rooms.add');
    }
    public function InsertRoom(Request $request){
    	$this->validate($request, [
      'room_name'   => 'required',
      'room_number'  => 'required|unique:rooms',
      'room_type'  => 'required',
      'price'  => 'required',
      'max_capacity'  => 'required',
      'num_of_bed'  => 'required',
      'descriptions'  => 'required',
      'facilities'  => 'required',
      'image'  => 'required | mimes:jpeg,jpg,png',
      'available'  => 'required',
      'publish'  => 'required',
     ]);
      $image=$request->image;
        $filename=$image->hashName();
        $store=$image->store('images','public');
        $request->image->move(public_path('/images'), $filename);
      $room=Room::create([
      'room_name'   => $request->room_name,
      'room_number'  => $request->room_number,
      'room_type'  => $request->room_type,
      'price'  => $request->price,
      'max_capacity'  => $request->max_capacity,
      'num_of_bed'  => $request->num_of_bed,
      'descriptions'  => $request->descriptions,
      'facilities'  => $request->facilities,
      'image'  => $filename,
      'available'  =>$request->available,
      'publish'  => $request->publish,
      ]);
      if($room){
        return redirect()->route('admin.room.add')->with('success','Room Added Success');
      }
    }
    public function EditRoom($id){
      $room=Room::find($id);
      return view('admin.rooms.edit')->with('room',$room);
    }

    public function UpdateRoom($id,Request $request){
      $this->validate($request, [
      'room_name'   => 'required',
      'room_number'  => 'required',
      'room_type'  => 'required',
      'price'  => 'required',
      'max_capacity'  => 'required',
      'num_of_bed'  => 'required',
      'descriptions'  => 'required',
      'facilities'  => 'required',
      'available'  => 'required',
      'publish'  => 'required',
     ]);
      $image=$request->image;
        
        
      $room=Room::find($id);
      
      if($request->has('image')){
          $filename=$image->hashName();
          $store=$image->store('images','public');
          $request->image->move(public_path('/images'), $filename);
          Storage::delete('/public/images/'.$room->image);
          \File::delete(public_path('images/'.$room->image));
        }
        else{
          $filename=$room->image;
        }
      $data=[
      'room_name'   => $request->room_name,
      'room_number'  => $request->room_number,
      'room_type'  => $request->room_type,
      'price'  => $request->price,
      'max_capacity'  => $request->max_capacity,
      'num_of_bed'  => $request->num_of_bed,
      'descriptions'  => $request->descriptions,
      'facilities'  => $request->facilities,
      'image'  => $filename,
      'available'  =>$request->available,
      'publish'  => $request->publish,
      ];
      $room->update($data);
      if($room){
        return redirect()->route('admin.room.edit',$id)->with('success','Room Update Success');
      }
    }
    public function DeleteRoom($id){
      $room=Room::find($id);
      Storage::delete('/public/images/'.$room->image);
      $room->delete();
      $room=Room::paginate(15);
      return view('admin.rooms.index')->with('room',$room);
    }
}
