@extends('admin.master')
@section('title','Admin Profile')
@section('body')
   <div class="col-sm-10">
        
     <h4 >Profile</h4>
   @include('layouts.flash_message')
      <hr>
     
            <div class="col-xs-10">
             
<form method="post" action="{{route('admin.profile.update')}}">
  @csrf
<label for="admin_name">  Username: </label> <br><input style="width: 400px;" type="text" placeholder="admin" value="{{$admin->name}}" readonly> <br><br>

<label for="email">  Email: </label> <br><input  style="width: 400px;" type="email" placeholder="admin@gmail.com" name="email" value="{{$admin->email}}">
<br><br>
<label for="password">  Password: </label> <br><input  style="width: 400px;" type="password" name="password" placeholder="admin@123">
<br><br>

<button class="btn btn-success" type="submit">Update</button>
</form>





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
      $("#update_profile").addClass('active');
</script>
@endsection