
<h4 >Room List ({{$room->total()}})</h4>
      <hr>
<div class="col-xs-12"><div class="top">
<div class="row">
<div class="col-md-3">
<a href="{{route('admin.room.list')}}"><button id="allRoom">All Rooms</button> </a>
</div>
<!--<div class="col-md-3">
<a href="{{route('admin.room.available')}}"><button id="availRoom">Available Room</button> </a>
</div>-->
<div class="col-md-3">
    <!-- Button trigger modal -->
<a href="#exampleModal" type="button" class="btn btn-info" data-toggle="modal" data-target="">
  Search Rooms
</a>
</div>
</div>
</div>
<br>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Extend Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('admin.extend.search')}}">
        @csrf
      <div class="modal-body">
        <div class="form-group"> 
          <label>Room Type</label>
              <select class="form-control" name="room_type" required>
              <option value="Single Room" disabled>Select Room Type</option>
              <option value="Single Room">Single Room</option>
              <option value="Double Room">Double Room</option>
              <option value="Tripple Room">Tripple Room</option>
              <option value="Twin Room">Twin Room</option>
              <option value="Deluxe Room">Deluxe Room</option>
              <option value="Studio Room">Studio Room</option>
              <option value="Luxury Room">Luxury Room</option>
              <option value="Presidential Room">Presidential Room</option>
              <option value="Queen Room">Queen Room</option>
            </select> </div>
            <div class="row">
              <div class="col-md-6">
                <div class="from-group">
                <label>Check In Date</label>
                <input type="date" class="form-control" name="check_in_date" id="check_in_date"  required>
              </div>
              </div>
              <div class="col-md-6">
                <div class="from-group">
                <label>Check Out Date</label>
                <input type="date" class="form-control" name="check_out_date" required>
              </div>
              </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Check Availability</button>
      </div>
    </form>
    </div>
  </div>
</div>
