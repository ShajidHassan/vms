@extends('layouts.adminLayout.admin_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1> Add Category</h1>
    <br>
  </div>

         <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Category</h5>


          </div>
            <br>
            


  <style>
form {
width:60%;
height:400px;
margin: 25px 50px 80px 100px;
position:relative;
}
 input {
width:60%;
height:40px;
 }
</style>

  


          <div class="widget-content nopadding">
              @if(Session::has('message_error'))
                  <div class="alert alert-error alert-block">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{!! session('message_error') !!}</strong>
                  </div>
              @endif
              @if(Session::has('message'))
                  <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{!! session('message') !!}</strong>
                  </div>
              @endif

            <form class="form-horizontal" method="post" action="{{\Illuminate\Support\Facades\URL::route('admin.add_category') }}" name="add_category" id="add_category" novalidate="novalidate"> {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" required>
           
                </div>
              </div>
            

 			  <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                   <select name="parent_id" style="width: 220px;">
                   	<option value="0">Main Category</option>
                   	@foreach($levels as $val)
                   	  <option value="{{ $val->id }}">{{ $val->name }}</option>
                   	  @endforeach
                   </select>
          	 </div>
              </div>

              {{-- <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description" required> </textarea> 
           
                </div>
              </div> --}}
              
              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url" required>
     
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Category" class="btn btn-success btn-block">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
</div>





@endsection