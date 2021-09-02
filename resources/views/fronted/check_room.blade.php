@extends('layouts.master')
@section('title','Rooms')
@section('content')

<div>
  

 <table class="table">
  <tr>
    <th>Room Name</th>
    <th>Room Price</th> 
    <th>Photo</th>
    <th width="15%">Action</th>

    </tr>
    @foreach($rooms as $room)
<tr>
  
  <td>{{$room->room_name}}</td>
  <td>{{$room->price}}</td>
  <td><img src="{{asset('images/'.$room->image)}}" width="100" height="100"></td>
  <td>
    <button type="button" class="btn btn-primary" data-id="{{$room->id}}" data-room_type="{{$room->room_type}}" data-toggle="modal" data-target="#roomModal">Book</button>
    <a href="{{route('room.details',$room->id)}}" class="btn btn-info">Details</a>
  </td>
  
</tr>


@endforeach
 
</table>




</div>
<!-- Modal-->
<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Number of Guest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form method="POST" action="{{route('room.booking')}}">
        @csrf
      <div class="modal-body">
        <input type="hidden" name="bid" id="bid" readonly>
        <input type="hidden" name="check_in_date" id="c_in_date" value="{{$check_in_date}}" readonly>
        <input type="hidden" name="check_out_date" id="c_out_date" value="{{$check_out_date}}" readonly>
        <input type="number" name="guest" id="c_guest" class="form-control" required>
        <input type="hidden" name="room_type" id="room_type" readonly>
        <br>
        <div id="content">
           
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Book Now</button>
      </div>
    </form>
    </div>
  </div>
</div>





@endsection
@section('custom_js')
<script type="text/javascript">
  $("#Rooms").addClass('active');

$('#roomModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var book_id = button.data('id') 
  var room_type = button.data('room_type') 
  var modal = $(this)
  modal.find('.modal-body #bid').val(book_id)
  modal.find('.modal-body #room_type').val(room_type)
})
</script>
@endsection