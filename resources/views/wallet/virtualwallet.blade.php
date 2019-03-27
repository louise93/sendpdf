
@extends('mainlayout.app')
@section('title', 'Fund Transfer')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
                    <h2>Wallet</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Virtual Wallet</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Transfer</a>
                        </li>
                    </ol>
                </div>
            <div class="col-lg-2">
      </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-4">
            @if(!empty(Session::get('message')))
                @if(Session::get('type') =='error')
                    <div class="alert alert-danger">{{Session::get('message')}}</div>
                @else
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
            @endif
              <div class="ibox-content">
                <h3 > VIRTUAL-WALLET BALANCE : ${{ number_format(DB::table('final_apin_wallet')->where('user_id',Auth::user()->user_id)->sum('amount'),2)}}</h3>
                <hr>
              <form class="m-t" role="form" method="post" action="{{URL::to('wallets/virtualwallet/transfer')}}">
                @csrf
                  <div class="form-group">
                    <label>Amount</label>
                      <input type="number" class="form-control" min="25"  name="amount" placeholder="Amount" required="">
                  </div>
                  <!-- <div class="form-group">
                    <label>Receiver</label>
                      <input type="text" class="form-control" name="receiver_id" placeholder="User ID/Username" required="">
                  </div> -->
                    <rwallet></rwallet>
                  <div class="form-group">
                    <label>Transaction Password</label>
                      <input type="password" class="form-control" name="transpassword" placeholder="" required="">
                  </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Transfer</button>
              </form>
            </div>
          </div>
      </div>
    </div>
@endsection
