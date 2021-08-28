@extends('layouts.adminLayout.admin_design')
@section('content')

  <br><br>
  <div id="content">
    <div id="content-header">
      <h1>Admin Transactions</h1>
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
              <h5>All Transaction</h5>
            </div>
            <div class="widget-content nopadding">
              <div>
                <table class="table table-bordered data-table">
                  <thead>
                  <tr>
                    <th>T.ID</th>
                    <th>From A.No </th>
                    <th>To A.No</th>
                    <th>Amount</th>
                    <th>Tax(%)</th>
                    <th>Tax. Amount</th>
                    <th>T.Type</th>
                    <th>T.Owner</th>
                    <th>A.Type</th>
                    <th>T.status</th>
                    <th>T. date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($allTransactions as $transaction)
                    <tr style="background-color:{{$transaction->trans_for == "super-admin" ? '#8fd19e' : ''}}">
                      <td>{{$transaction->id}}</td>
                      <td>{{$transaction->from_account}}</td>
                      <td>{{$transaction->to_account}}</td>
                      <td>{{$transaction->amount ?? "NA"}}</td>
                      <td>{{$transaction->tax ?? "NA"}}</td>
                      <td>{{$transaction->tax_amount?? "NA"}}</td>
                      <td>{{$transaction->trans_type}}</td>
                      <td>{{$transaction->trans_for}}</td>
                      <td>{{$transaction->amount_type}}</td>
                      <td>{!! \App\Helper::getStatus($transaction->status) !!}</td>
                      <td>{{$transaction->created_at}}</td>
                      <td class="center">
{{--                        <a href="{{\Illuminate\Support\Facades\URL::route("user.edit_account",['id' => $transaction->id])}}" class="btn btn-info btn" title="edit">Edit</a>--}}
                        <a href="{{\Illuminate\Support\Facades\URL::route("admin.view_transaction",['id' => $transaction->id])}}" class="btn btn-success btn" title="View">Detail</a>
{{--                        <a onclick=" window.confirm('are you sure ?') && document.getElementById('delete_account').submit(); return false;"class="btn btn-danger btn" title="delete">Delete</a>--}}
{{--                        <form id="delete_account" method="post" action="{{ \Illuminate\Support\Facades\URL::route('user.delete_account') }}">--}}
{{--                          <input type="hidden" name="acc_id" value="{{$transaction->id}}">--}}
{{--                          {{csrf_field()}}--}}
{{--                        </form>--}}
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
