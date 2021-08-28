@extends('layouts.adminLayout.admin_design')
@section('content')
<br><br>
<div id="content">
  <div id="content-header">
    <h1>Categories</h1>

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
            <h5>View Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Category Level</th>
                  <th>Category URL</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($categories as $category)
                <tr class="gradeX">
                	<td style="text-align: center;">{{ $category->id }}</td>
                	<td style="text-align: center;">{{ $category->name }}</td>
                  <td style="text-align: center;">{{ $category->parent_id }}</td>
                	<td style="text-align: center;">{{ $category->url }}</td>
                	<td style="text-align: center;" class="center">
                      <a href="{{ \Illuminate\Support\Facades\URL::route('admin.edit_category',['id'  => $category->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                      <a onclick='window.confirm("are you sure ?") && document.getElementById("delete_category_{{$category->id}}").submit(); return false;' class="btn btn-danger btn-xsi">Delete</a></td>
                  <form id="delete_category_{{$category->id}}" method="post" action="{{ \Illuminate\Support\Facades\URL::route('admin.delete_category') }}">
                    <input type="hidden" name="c_id" value="{{$category->id}}">
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
</div>



@endsection