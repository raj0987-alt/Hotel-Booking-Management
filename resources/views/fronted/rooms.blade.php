@extends('layouts.master')
@section('title','Rooms')
@section('content')

<div class="col-xs-12">
  @include('layouts.flash_message')
  <div class="check">
  
<form id="form" method="post" action="{{route('room.checkAvail')}}">
  @csrf
  <div class="row">
    <div class="col-md-3">
      <label >Check_in date: </label> 

  <input type="date" name="check_in_date" id="check_in_date"> 

    </div>
    <div class="col-md-3">
      <label>Check_out date: </label>
  <input type="date" name="check_out_date" id="check_out_date">
    </div>
    <div class="col-md-3">
      <label> Room Type: </label>
    
      <select style="padding: 6px" name="room_type">
                    <option value="" disabled>Select Room Type</option>
                    <option value="Single Room">Single Room</option>
                    <option value="Double Room">Double Room</option>
                    <option value="Tripple Room">Tripple Room</option>
                    <option value="Twin Room">Twin Room</option>
                    <option value="Deluxe Room">Deluxe Room</option>
                    <option value="Studio Room">Studio Room</option>
                    <option value="Luxury Room">Luxury Room</option>
                    <option value="Queen Room">Queen Room</option>
                    <option value="Presidential Room">Presidential Room</option>  

        </select>
    </div>
    <div class="col-md-3">
      <button class="checkAvail" type="submit">Check Availability</button>
    </div>
  </div>
  
</form>
</div>
      </div>

 <div class="container">

@foreach($rooms as $room)
<div class="box">
    <div class="imgBox">
        <img src="{{asset('images/'.$room->image)}}" >
      </div>
      <div class="details">
          <div class="content">
              <h1>{{$room->room_name}}</h1>
              <p> Per Night: {{$room->price}} USD </p> 
              <p>Max Capacity: {{$room->max_capacity}}</p>
              <p>{{$room->room_type}}</p>

               <br><br> <br>
              <a  href="{{route('room.book_now',$room->id)}}">Available?</a>
      </div>
      </div>

</div>
@endforeach

   </div>
   <br><br>
@endsection
@section('custom_js')
<script type="text/javascript">
  $("#Rooms").addClass('active');

$('#check_in_date').change(function(){
        var check_in_date=$(this).val();
        console.log(check_in_date);
        var now = new Date();
    var today = now.getFullYear()  + '-' + ('0' + (now.getMonth() +1)).slice(-2) + '-' +('0'+ now.getDate() ).slice(-2) ; 
 
    if(today>check_in_date){
      $(this).val('');
      
      
    }
      });
      $('#check_out_date').change(function(){
        var check_out_date=$(this).val();
        
        var now = new Date();
    var today = now.getFullYear()  + '-' + ('0' + (now.getMonth() +1)).slice(-2) + '-' +('0'+ now.getDate() ).slice(-2) ; 
 
    if(today>check_out_date){
      $(this).val('');
      
      
    }
      });
</script>
@endsection