@extends('layouts.marchantLayout.marchant_design')
@section('content')

<br><br>
<div id="content">
   <div id="content-header">
    <h1>Sale Edit</h1>
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

    <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Sale Form</h5>
          </div>
          <div class="widget-content nopadding">
            <form id="update_sale_form" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ \Illuminate\Support\Facades\URL::route("vechicles.sale_update") }}" novalidate="novalidate">
              {{ csrf_field() }}
              <legend>Sale Information</legend>
              <input type="hidden" name="s_id" value="{{$sale->id}}" />
              <div style="width:100%; height: 60px; float: right;" class="control-group">
                <div class="control-group">
                  <label class="control-label"><strong>Choose Your Diposit Account</strong></label>
                  <div class="controls">
                    <select name="account_key" id="account_number">
                      @foreach($accounts as $key => $accountNumber)
                        <option value="{{$key}}" {{$sale->diposit_acount == $accountNumber ? 'selected' : null}}>{{$accountNumber}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">S.Quantity</label>
                <div class="controls">
                  <input type="number" value="{{$sale->sold_qty}}" name="qty" id="qty" required />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Sale Price</label>
                <div class="controls">
                  <input type="number" value="{{$sale->sale_price}}" name="sale_price" id="sale_price" required />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Booking Rate(%)</label>
                <div class="controls">
                  <input type="number" value="{{$sale->booking_rate}}" name="rate" id="rate" required />
                </div>
              </div>
              <legend>Showroom Information</legend>
              <div class="control-group">
                <label class="control-label">Showroom Name</label>
                <div class="controls">
                  <input type="text" value="{{$sale->show_room}}" name="showroom_name" id="showroom_name" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address</label>
                <div class="controls">
                  <textarea name="address" id="address" required>{{$sale->address}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Contact Number</label>
                <div class="controls">
                  <input type="number" value="{{$sale->phone}}" name="contact" id="contact" required>
                </div>
              </div>
              <div style="width: 100%; height: 40px; float: left; background-color:white " class="form-actions">
                <input type="submit" value="Update Sale" class="btn btn-primary btn-block">
              </div>
            </form>
          </div>
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
