@extends('layouts.marchantLayout.marchant_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1 style="color:black;font-weight: bold">Edit Account</h1>
     @if(\Illuminate\Support\Facades\Session::has('message_error'))
     <div class="alert alert-error alert-block">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>{!! session('message_error') !!}</strong>
     </div>
     @endif
     @if(\Illuminate\Support\Facades\Session::has('message'))
     <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>{!! session('message') !!}</strong>
     </div>
     @endif
  </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Account</h5>
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

            <form id="acc_edit_account" class="form-horizontal" method="POST" action="{{ \Illuminate\Support\Facades\URL::route('marchant.update_account') }}">
                @CSRF
                {{method_field("PUT")}}
                <input type="hidden" name="id" value="{{$account->id}}">
                <div  class="control-group">
                   Acc. Number : {{$account->acc_no}}
                </div>
              <div class="control-group" >
                <label class="control-label">Holder Name:</label>
                <div class= "controls">
                  <input type="text" value="{{ $account->holder_name}}" name="holder_name"  required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Bank Name:</label>
                <div class="controls">
                  <input type="text" value="{{ $account->bank_name}}" name="bank_name" required>
                </div>
              </div>

              <div  class="control-group">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <input type="text" value="{{ $account->branch_name}}" name="branch_name" required>
                </div>
              </div>

              <div class="control-group">
                <label for="branch_address" class="control-label">Branch Address</label>
                <div class="controls">
                  <textarea name="branch_address" >{{ $account->address}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Initialize Amount:</label>
                <div class="controls">
                  <input type="number" value="{{ $account->amount}}" name="amount" required>
                </div>
              </div>
              <div class="form-actions">
                <input name="acc_update" type="submit" value="Update Account" class="btn btn-primary btn-block">
              </div>
            </form>
          </div>
        </div>
</div>
@endsection