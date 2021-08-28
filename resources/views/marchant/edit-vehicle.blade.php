@extends('layouts.marchantLayout.marchant_design')
@section('content')
    <br><br>
    <div id="content">
        <div id="content-header">
            <h1 style="color:black; font-weight:bold">Edit Vechicle</h1>
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
                <h5>Edit Vehicle</h5>
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
                <form id="new_purchase_form" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ \Illuminate\Support\Facades\URL::route("vechicles.update") }}" novalidate="novalidate">
                    {{ csrf_field() }}
                    <legend>Vechicle Information</legend>
                    <input type="hidden" name="id" value="{{$vechicle->id}}">
                    <div style="width:100%; height: 60px; float: right;" class="control-group">
                        <label class="control-label">Under Category</label>
                        <div class="controls">
                            <select name="category_id" id="category_id" style="width: 220px;">
                                {!! $categories_dropdown !!}
                            </select>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px;float: left;" class="control-group" >
                        <label class="control-label">Brand</label>
                        <div class= "controls">
                            <input type="text" value="{{$vechicle->brand}}" name="brand" id="brand" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Model</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->model}}" name="model" id="model" required>
                        </div>
                    </div>


                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Year</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->year}}" name="year" id="year" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Mileage</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->mileage}}" name="mileage" id="mileage" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Engine Capacity</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->engine_capacity}}" name="engine_capacity" id="engine_capacity" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Fuel Type</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->fuel_type}}" name="fuel_type" id="fuel_type" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Max Power</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->max_power}}" name="max_power" id="max_power" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Max Speed</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->max_speed}}" name="max_speed" id="max_speed" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Torque</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->torque}}" name="torque" id="torque" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Fuel Consumption</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->fuel_consumption}}" name="fuel_consumption" id="fuel_consumption" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Door</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->door}}" name="door" id="door" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Drive Type</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->drive_type}}" name="drive_type" id="drive_type" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Seats</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->seats}}" name="seats" id="seats" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Wheel Base</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->wheel_base}}" name="wheel_base" id="wheel_base" required>
                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Weight</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->weight}}" name="weight" id="weight" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Length</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->length}}" name="length" id="length" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Width</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->width}}" name="width" id="width" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Height</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->height}}" name="height" id="height" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Fuel Tank Capacity</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->fuel_tank_capacity}}" name="fuel_tank_capacity" id="fuel_tank_capacity" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">Color</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->color}}" name="color" id="color" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 40px; float: left;" class="control-group">
                        <label class="control-label">No of Cylinder</label>
                        <div class="controls">
                            <input type="text" value="{{$vechicle->no_of_cylinder}}" name="no_of_cylinder" id="no_of_cylinder" required>

                        </div>
                    </div>

                    <div style="width: 50%; height: 80px; float: left;" class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <textarea name="description" id="description" required>{{$vechicle->description}}</textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Image</label>
                        <div class="controls">
                            <input type="hidden" name="current_image" value="{{ $vechicle->image }}">
                            <input type="file" name="image" id="image" required>
                        </div>
                    </div>
                    <div style="width: 100%; height: 40px; float: left; background-color:white " class="form-actions">
                        <input type="submit" value="Update" class="btn btn-primary btn-block">
                    </div>
                </form>
@endsection