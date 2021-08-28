@extends('layouts.marchantLayout.marchant_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1 style="color:black;font-weight: bold">Detail Transaction</h1>
  </div>
        <div class="widget-box">
          <style>
form {
width:60%;
height:400px;
margin: 25px 50px 80px 100px;
position:relative;
}
</style>
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i></span>
                    <h5>Sold History</h5>
                    <div>
                        <a href="{{\Illuminate\Support\Facades\URL::route("vechicles.details",['id'=> $sale->vechicle_id])}}" class="btn btn-success btn">View Vechicle</a>
                    </div>
                </div>
                <div style="background-color:white" class="widget-content nopadding">
                    <form class="form-horizontal">
                            <div  class="control-group">
                               Sale ID : {{$sale->id}}
                            </div>
                          <div class="control-group" >
                              Marchant: {{ session()->get("marchant_email") ?? "NA" }}
                          </div>
                          <div class="control-group" >
                              Diposit Account: {{ $sale->diposit_account ?? '' }}
                          </div>
                          <div class="control-group">
                            Available qty:{{ $sale->sold_qty ?? '' }}
                          </div>
                        <div class="control-group">
                            Principal Amount:{{ $sale->sale_price ?? '' }}
                        </div>
                            <div class="control-group">
                                B. Rate(%):{{ $sale->booking_rate ?? '' }}
                            </div>
                            <div class="control-group">
                                Booking Amount:{{ round(($sale->sale_price * ($sale->booking_rate / 100)),2) ?? "NA" }}
                            </div>
                            <div class="control-group">
                                Show room:{{ $sale->show_room ?? '' }}
                            </div>
                            <div class="control-group">
                                Contract Number:{{ $sale->phone ?? '' }}
                            </div>
                            <div class="control-group" style="font-weight: bold;color:darkslategray;">
                                Address:{{ $sale->address ?? '' }}
                            </div>
                        <div class="control-group" style="font-weight: bold;color:darkslategray;">
                            Sale:{!! \App\Helper::getStatus($sale->action) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection