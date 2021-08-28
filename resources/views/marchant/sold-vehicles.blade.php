@extends('layouts.marchantLayout.marchant_design')
@section('content')

<br><br>
<div id="content">
   <div id="content-header">
    <h1>Sold Vehicle</h1>
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
        <div>
          <div class="modal-header">
            <h2><strong>Summary</strong></h2>
          </div>
          <div class="modal-body">
            <strong>
              <h2>Brand Name :{{ $vehicle->brand }}</h2>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Category Name: {{ $vehicle->category->name }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Model: {{ $vehicle->model }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Year: {{ $vehicle->year }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Mileage: {{ $vehicle->mileage }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Engine Capacity: {{ $vehicle->engine_capacity }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Fuel Type: {{ $vehicle->fuel_type }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Max Power: {{ $vehicle->max_power }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Max Speed: {{ $vehicle->max_speed }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Torque: {{ $vehicle->torque }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Fuel Consumption: {{ $vehicle->fuel_consumption }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Door: {{ $vehicle->door }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Drive Type: {{ $vehicle->drive_type }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Seats: {{ $vehicle->seats }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Wheel Base: {{ $vehicle->wheel_base }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Weight: {{ $vehicle->weight }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Length: {{ $vehicle->length }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Width: {{ $vehicle->width }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Height: {{ $vehicle->height }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Fuel Tank Capacity: {{ $vehicle->fuel_tank_capacity }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Color: {{ $vehicle->color }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>No of Cylinder: {{ $vehicle->no_of_cylinder }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Description: {{ $vehicle->description }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Price: {{ $vehicle->sale_price ?? "NA"}} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Showroom Name: {{ $vehicle->showroom_name }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Address: {{ $vehicle->address }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Contact: {{ $vehicle->contact }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
            </strong>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Last Purchases History</h5>
          </div>
          <div class="modal-body">
            <strong>
              <p>P.Quantity :{{ $lastPurchases->qty }}</p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>P.Price: {{ $lastPurchases->cost_price }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>T.Amount: {{ $lastPurchases->total_amount}} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>P.date: {{ $lastPurchases->created_at }} </p>
            </strong>
          </div>
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Sale Form</h5>
          </div>
          <div class="widget-content nopadding">
            <form id="new_sale_form" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ URL::to('/marchant/sold-vehicle') }}" novalidate="novalidate">
              {{ csrf_field() }}
              <legend>Sale Information</legend>
              <input type="hidden" name="v_id" value="{{$vehicle->id}}" />
              <div style="width:100%; height: 60px; float: right;" class="control-group">
                <div class="control-group">
                  <label class="control-label"><strong>Choose Your Diposit Account</strong></label>
                  <div class="controls">
                    <select name="account_key" id="account_number">
                      @foreach($accounts as $key => $accountNumber)
                        <option value="{{$key}}">{{$accountNumber}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">S.Quantity</label>
                <div class="controls">
                  <input type="number" name="qty" id="qty" required />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Sale Price</label>
                <div class="controls">
                  <input type="number" name="sale_price" id="sale_price" required />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Booking Rate(%)</label>
                <div class="controls">
                  <input type="number" name="rate" id="rate" required />
                </div>
              </div>
              <legend>Showroom Information</legend>
              <div class="control-group">
                <label class="control-label">Showroom Name</label>
                <div class="controls">
                  <input type="text" name="showroom_name" id="showroom_name" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address</label>
                <div class="controls">
                  <textarea name="address" id="address" required></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Contact Number</label>
                <div class="controls">
                  <input type="number" name="contact" id="contact" required>
                </div>
              </div>
              <div style="width: 100%; height: 40px; float: left; background-color:white " class="form-actions">
                <input type="submit" value="New Sale" class="btn btn-primary btn-block">
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
