@extends('admin.master')
@section('title','Messages')
@section('body')
<div class="col-sm-10">
        
      <h4><Medium>Message Reply </Medium></h4>
      <hr>
     
      <!--display window-->
      
            <div class="col-xs-10">
             @include('layouts.flash_message')
                <div >
									
                    <form method="post" >
                    	@csrf
                        
                        <div class="form-group"> 
                        	<label for="exampleInputEmail1">Message ID</label> 
                        	<input type="text" class="form-control" name="msg_id" value="{{$msg->id}}" readonly> 
                        </div>
                        <div class="form-group"> 
                        	<label for="exampleInputEmail1">Message Text</label> 
                        	<input type="text" class="form-control" name="msg_id" value="{{$msg->message_body}}" readonly> 
                        </div>
                        <div class="form-group"> 
                        	<label for="exampleInputEmail1">Message Reply</label> 
                        	<textarea name="reply_msg" class="form-control" value="{{$msg->replied_message}}"></textarea>
                        </div>
					 <button type="submit" class="btn btn-primary" name="submit">Reply</button>
                   </form> 
                </div>
            </div>
        </div>
    </div>


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
<script type="text/javascript">
      $("#Messages").addClass('active');
</script>
@endsection