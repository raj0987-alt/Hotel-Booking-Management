@extends('admin.master')
@section('title','Message')
@section('body')
   <div class="col-sm-10">
        <br>

        <div>

        <a  style="text-decoration: none;"  href="{{route('message.unread')}}">
        <h4 style="background-color: red;color: white; padding: 8px 15px; width: 180px;">Unread Messages</h4>
    </a>
</div>

<div id="next">
     
        <br>
        <h4 style="background-color: green;color: white; padding: 8px 15px; width: 170px;" >Read Messages</h4>

    </div>
       
      <hr>
            <div class="col-xs-12">
<table style="width: 100%;">

    <tr class="title">

<th>Serial No</th>
<th>Name</th>
<th>Email</th>
<th>Phone Number</th>
<th>Messages</th>
<th>Replied </th>
<th>Messages Date</th>
    </tr>
@foreach($read_msg as $key=>$msg)
<tr>
	<td>{{$key+1}}</td>
  @if($msg->user_id)
	<td>{{$msg->name}}</td>
  @else
  <td>No user</td>
  @endif
	<td>{{$msg->email}}</td>
	<td>{{$msg->mobile}}</td>
	<td>{{$msg->message_body}}</td>
  <td>{{$msg->replied_message}}</td>
	<td>{{$msg->created_at}}</td>
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


@endsection

@section('custom_js')
<script type="text/javascript">
      $("#Messages").addClass('active');
</script>
@endsection