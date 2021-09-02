@extends('layouts.master')

@section('content')
<div class="container-fluid" style="padding-top: 70px">
<div class="row">
  <div class="col-sm-3">
    <a href="/home">
My Bookings

</a>
<br><br>

<a href="{{route('profile')}}" >My Profile</a>
<br><br>
<a class="active" href="{{route('user.message')}}" >Message</a>
<br><br>
<a href="{{route('password_change')}}">
Change Password

</a>
  </div>
	<div class="col-sm-9">

  <table class="table table-bordered">

<tr>

<td>SN</td>
<th>Messages</th>
<th>Replied</th>
<th>Last Update</th>
<th>Status</th>
</tr>
@foreach($message as $key=>$msg)
<tr>
  <td>{{$key+1}}</td>
  <td>{{$msg->message_body}}</td>
  <td>{{$msg->replied_message}}</td>
  <td>{{$msg->updated_at}}</td>
  @if($msg->status=='replied')
  <td>Closed</td>
  @else
  <td>Waiting for response</td>
  @endif
</tr>
@endforeach
</table>
<a href="{{route('contact')}}" class="btn btn-primary">Create New Message</a>
</div>
 </div>
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
  $("#Profile").addClass('active');
</script>
@endsection