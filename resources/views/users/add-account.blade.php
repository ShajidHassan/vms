@extends('layouts.userLayout.user_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1 style="color:black;font-weight: bold">Add Account</h1>
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
  </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Account</h5>
          </div>
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
          <div style="background-color:white; " class="widget-content nopadding">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form id="add_account" class="form-horizontal" method="post" action="{{ URL::to('/user/add-account') }}" name="add_vehicle" id="add_vehicle" novalidate="novalidate">
              {{ csrf_field() }}
              <div class="control-group" >
                <label class="control-label">Holder Name:</label>
                <div class= "controls">
                  <input type="text" name="holder_name" id="holder_name" required>
                </div>
              </div>

              <div  class="control-group">
                <label class="control-label">Acc. Number</label>
                <div class="controls">
                  <input type="text" name="acc_number" id="acc_number" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Bank Name:</label>
                <div class="controls">
                  <input type="text" name="bank_name" id="bank_name" required>
                </div>
              </div>

              <div  class="control-group">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <input type="text" name="branch_name" id="branch_name" required>
                </div>
              </div>

              <div class="control-group">
                <label for="branch_address" class="control-label">Branch Address</label>
                <div class="controls">
                  <textarea name="branch_address" id="branch_address"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Initialize Amount:</label>
                <div class="controls">
                  <input type="number" name="amount" id="amount" required>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Account" class="btn btn-primary btn-block">
              </div>
            </form>
          </div>
@endsection