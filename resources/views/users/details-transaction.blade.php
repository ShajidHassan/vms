@extends('layouts.userLayout.user_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1 style="color:black;font-weight: bold">Detail Transaction</h1>
  </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Detail Transaction</h5>
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
                   T. Number : {{$transaction->id}}
                </div>
              <div class="control-group" >
                  Form Account: {{ $transaction->from_account ?? '' }}
              </div>
              <div class="control-group" >
                  Form Account: {{ $transaction->to_account ?? '' }}
              </div>
              <div class="control-group">
                Principal Amount:{{ $transaction->amount ?? '' }}
              </div>
                <div class="control-group">
                    Tax(%):{{ $transaction->tax ?? '' }}
                </div>
                <div class="control-group">
                    Tax Amount:{{ $transaction->tax_amount ?? '' }}
                </div>
                <div class="control-group">
                    Transaction Type:{{ $transaction->trans_type ?? '' }}
                </div>
                <div class="control-group">
                    Transaction On:{{ $transaction->amount_type ?? '' }}
                </div>
                <div class="control-group" style="font-weight: bold;color:darkslategray;">
                    Note:
                    {{ $transaction->note ?? '' }}
                </div>
            </form>
          </div>
@endsection