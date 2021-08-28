@extends('layouts.marchantLayout.marchant_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1 style="color:black;font-weight: bold">Detail Account</h1>
  </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Detail Account</h5>
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
            <form class="form-horizontal">
                <div  class="control-group">
                   Acc. Number : {{$account->acc_no}}
                </div>
              <div class="control-group" >
                Holder Name: {{ $account->holder_name ?? '' }}
              </div>
              <div class="control-group">
                Bank Name:{{ $account->bank_name ?? '' }}
              </div>
              <div  class="control-group">
                Branch Name:{{ $account->branch_name ?? '' }}
              </div>
              <div class="control-group">
               Branch Address:
                  {{ $account->address ?? '' }}
              </div>
              <div class="control-group">
                Amount:{{ $account->amount ?? 0 }} TK
              </div>

            </form>
          </div>
@endsection