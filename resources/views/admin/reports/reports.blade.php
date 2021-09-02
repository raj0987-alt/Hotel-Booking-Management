@extends('admin.master')
@section('title','Reports')
@section('body')
   <div class="col-sm-10" >
        
     <h4 >Bookings Reports</h4>
  <div class="row">
      <div class="col-sm-10 " style="align-content: right"></div>
      <div class="col-sm-2" style="padding: 10px"><button type="button" class="btn btn-primary btn-lg btn-block" onclick="javascript:printDiv('print')">Print Result</button></div>
  </div>
<div class="row mt-20" id="print"> 

<table style="width: 100%;">

    <tr class="title">
    <th>Serial No</th>
<th>Room Type</th>
<th>Room Number</th>
<th>Name</th>
<th>Phone Number</th>
<th>Check In Date</th>
<th>Check Out Date</th>
<th>Booking Date</th>
<th>Status</th>

    </tr>
@foreach($booking as $key=>$book)
    <tr>
    <th width="1%">{{$key+1}}</th>
        <th>{{$book->room_type}}</th>
        <th width="1%">{{$book->room_number}}</th>
        <th>{{$book->name}}</th>
        <th>{{$book->mobile}}</th>
        <th>{{$book->check_in_date}}</th>
        <th>{{$book->check_out_date}}</th>
        <th>{{$book->created_at}}</th>
        <th>{{$book->status}}</th>
    </tr>
@endforeach
</table>
</div>

            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_js')
<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
    </script>
    @endsection
    @section('custom_js')
<script type="text/javascript">
      $("#Reports").addClass('active');
</script>
@endsection