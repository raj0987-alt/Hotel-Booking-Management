@extends('layouts.master')
@section('title','Book Now')
@section('content')
<div class="container">
	<div class="col-md-6">
		<div class="row ">
<div class="card bg-light mb-6" >
  <div class="card-header"><img src="{{asset('images/'.$room->image)}}" width="100%"></div>
  <div class="card-body">
    <h5 class="card-title center">{{$room->room_name}}</h5>
    <h5 class="card-title btn btn-primary">Price: {{$room->price}} USD</h5>
        <p class="card-text"><b>Room Number</b>: {{$room->room_number}}</p>

    <p class="card-text"><b>Room Type</b>: {{$room->room_type}}</p>
    <p class="card-text"><b>Number Of Bed's</b>: {{$room->num_of_bed}}</p>
    <p class="card-text"><b>Max Capacity</b>: {{$room->max_capacity}}</p>
    <p class="card-text"><b>Facility</b>: {{$room->facilities}}</p>
    <p class="card-text"><b>Description</b>: {{$room->descriptions}}</p>
  </div>
</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card bg-light mb-6" >
  <div class="card-header">Booking Form</div>
  @include('layouts.flash_message')
  <div id="msg"></div>
  <div class="card-body">
    <form method="post" action="{{route('room.booking_confirmation',$room->id)}}">
    	@csrf
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label" >Check In Date</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="{{ old('check_in_date',date('Y-m-d')) }}" >
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Check Out Date</label>
    <div class="col-sm-8"> 
      <input type="date" class="form-control" id="check_out_date" value="{{ old('check_out_date',date('Y-m-d')) }}" name="check_out_date" placeholder="Choose Check Out Date">
    </div>
  </div>
  <div class="form-group row">
  	<label class="col-sm-4">Guest </label>
  	<div class="col-sm-8">
  		<select class="form-control" id="guest" name="guest" type="text" >
                        <option value="Guest" disabled="">Guest Number</option>
                        <option value="1" {{ old('guest') == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ old('guest') == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ old('guest') == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ old('guest') == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ old('guest') == 5 ? 'selected' : '' }}>5</option>
                        </select>
  	</div>
  </div>
    <div class="form-group row">
  	<label class="col-sm-4">Room Type </label>
  	<div class="col-sm-8">
  		<!-- <select class="form-control" name="room_type" type="text">
                    <option value="">Room Type</option>
                    <option value="1">Single Room</option>
                    <option value="2">Double Room</option>
                    <option value="3">Tripple Room</option>
                    <option value="4">Twin Room</option>
                    <option value="5">Deluxe Room</option>
                    <option value="5">Studio Room</option>
                    <option value="5">Luxury Suite</option>
                    <option value="5">Queen Room</option>
                    <option value="5">Presidential Suite</option>  

        </select> -->
        <input type="text" name="room_type" id="room_type" value="{{$room->room_type}}" class="form-control" readonly>
  	</div>
  </div>
  
  <div class="form-group row clearfix">
    <div class="col-sm-10">
      <input type="button" id="check_btn" name="action" class="btn btn-primary" value="Check Availability">
      
    </div>
  </div>
</form>
  </div>
</div>
	</div>
</div>
<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('room.booking_confirmation',$room->id)}}">
        @csrf
      <div class="modal-body">
        <input type="hidden" name="c_in_date" id="c_in_date">
        <input type="hidden" name="c_out_date" id="c_out_date">
        <input type="hidden" name="c_guest" id="c_guest">
        <input type="hidden" name="c_room_type" id="c_room_type">
        <div id="content">
          
        </div>
        <input type="submit" id="book_btn" name="action" class="btn btn-primary" value="Book Now">
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
  $("#Rooms").addClass('active');

</script>
<script type="text/javascript">

    $(document).ready(function(){
    $('#check_btn').on('click', function(){
      var check_in_date = $("#check_in_date").val();
        var check_out_date = $("#check_out_date").val();
        var guest = $("#guest").val();
        var room_type = $("#room_type").val();
        if(check_in_date!='' && check_out_date!=''){
          $.ajax({
           type:'get',
           url:"{{route('room.availability',$room->id)}}",
           data:{
            check_in_date:check_in_date, 
            check_out_date:check_out_date, 
            guest:guest,
            room_type:room_type
          },
           success:function(data){
            var mydata='<p>'+data.success+'</p>';
            $('#content').html(mydata);
            if(data.success=='Room already Booked'){
              $('#book_btn').hide();
            }
            else{
              $('#book_btn').show();
            }
              $('#roomModal').modal('show');
              $('#c_in_date').val(check_in_date);
              $('#c_out_date').val(check_out_date);
              $('#c_guest').val(guest);
              $('#c_room_type').val(room_type);
              

           }
          
        });
    }

    });

});
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
