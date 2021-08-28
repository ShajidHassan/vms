@extends('layouts.marchantLayout.marchant_design')
@section('content')

  <br><br>
  <div id="content">
    <div id="content-header">
      <h1>Accounts</h1>
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
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>View Transaction</h5>
            </div>
            <div class="widget-content nopadding">
              <div>
                <table class="table table-bordered data-table">
                  <thead>
                  <tr>
                    <th>Acc.ID</th>
                    <th>Acc. Number</th>
                    <th>Holder Name</th>
                    <th>BankName</th>
                    <th>Branch Name</th>
                    <th>Address</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($accounts as $account)
                      <tr>
                        <td>{{$account->id}}</td>
                        <td>{{$account->acc_no}}</td>
                        <td>{{$account->holder_name}}</td>
                        <td>{{$account->bank_name ?? "NA"}}</td>
                        <td>{{$account->branch_name ?? "NA"}}</td>
                        <td>{{$account->address ?? "NA"}}</td>
                        <td>{{$account->amount}}</td>
                        <td class="center">
                          <a href="{{\Illuminate\Support\Facades\URL::route("marchant.edit_account",['id' => $account->id])}}" class="btn btn-info btn" title="edit">Edit</a>
                          <a href="{{\Illuminate\Support\Facades\URL::route("marchant.view_account",['id' => $account->id])}}" class="btn btn-success btn" title="View">Detail</a>
                          <a onclick='window.confirm("are you sure ?") && document.getElementById("delete_account_{{$account->id}}").submit(); return false;' class="btn btn-danger btn" title="delete">Delete</a>
                          <form id="delete_account_{{$account->id}}" method="post" action="{{ \Illuminate\Support\Facades\URL::route('marchant.delete_account') }}">
                            <input type="hidden" name="acc_id" value="{{$account->id}}">
                            {{csrf_field()}}
                          </form>
                        </td>
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
