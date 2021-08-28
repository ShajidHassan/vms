@extends('layouts.marchantLayout.marchant_design')
@section('content')

<br><br>
<div id="content">
   <div id="content-header">
    <h1>Vehicles</h1>

    @if(Session::has('message_error'))
     <div class="alert alert-error alert-block">
     	<button type="button" class="close" data-dismiss="alert">x</button>
     	<strong>{!! session('flash_message_error') !!}</strong>
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
            <h2><strong>Full Details</strong></h2>
          </div>
          <div class="modal-body">
            <strong><h2>Brand Name :{{ $vehicle->brand }}</h2>
              <p>Vehicle ID: {{ $vehicle->id }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Category Name: {{ $vehicle->category->name }} </p>
              <hr style="height:2px;margin-top:-0.5em;border-width:0;color:gray;background-color:#0E6655">
              <p>Brand: {{ $vehicle->brand }} </p>
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
            <h5>Purchses History</h5>
          </div>
          <div class="widget-content nopadding">
            <div class="widget-content nopadding">
              <div>
                <table class="table table-bordered data-table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Total Amount</th>
                    <th>Tax Amount</th>
                    <th>Show Room</th>
                    <th>Phone</th>
                    <th>P.date</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($vehicle->purchasses as $purchases)
                    <tr>
                      <td>{{$purchases->id}}</td>
                      <td>{{$purchases->qty ?? "NA"}}</td>
                      <td>{{$purchases->cost_price ?? "NA"}}</td>
                      <td>{{$purchases->total_amount ?? "NA"}}</td>
                      <td>{{$purchases->tax ?? "NA"}}</td>
                      <td>{{$purchases->show_room_name?? "NA"}}</td>
                      <td>{{$purchases->phone?? "NA"}}</td>
                      <td>{{$purchases->created_at}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





@endsection
