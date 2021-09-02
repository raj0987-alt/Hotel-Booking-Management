@extends('layouts.master')
@section('title','Book Now')
@section('content')
<div class="container">
	<div class="col-md-10">
		<div class="row ">
<div class="card bg-light mb-10" >
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

</div>

@endsection
@section('custom_js')
<script type="text/javascript">
  $("#Rooms").addClass('active');

</script>
@endsection
