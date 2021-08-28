@extends('layouts.adminLayout.admin_design')
@section('content')

<br><br>
<div id="content">
   <div id="content-header">
    <h1>Admins</h1>

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
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Admins</h5>
          </div>
          <div class="widget-content nopadding">
            <div>
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Marchant Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Type</th>
                  <th>Member Since</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($admins as $admin)
                <tr class="gradeX">
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->gender }}</td>
                  <td>{{ $admin->type == "Admin" ? "Marchant" : "Marchant" }}</td>
                  <td>{{ $admin->created_at }}</td>
                	<td class="center">
{{--                      <a href="{{\Illuminate\Support\Facades\URL::route("vechicles.edit",['id'=>$vehicle->id])}}" class="btn btn-primary btn-xs" >Edit</a>--}}
                      <a onclick='window.confirm("are you sure ?") && document.getElementById("delete_admin_{{$admin->id}}").submit(); return false;' class="btn btn-danger btn-xsi" >Trash</a>
                    </td>
                    <form id="delete_admin_{{$admin->id}}" method="post" action="{{ \Illuminate\Support\Facades\URL::route('admin.delete_admin') }}">
                      <input type="hidden" name="ad_id" value="{{$admin->id}}">
                      {{csrf_field()}}
                    </form>
                </tr>
                @endforeach
              </tbody>

            </table>
        </div>
      </div>
    </div>
  </div>
</div>





@endsection
