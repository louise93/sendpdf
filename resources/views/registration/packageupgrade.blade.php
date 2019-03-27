
@extends('mainlayout.app')

@section('title', 'Package Activation')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Activate</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Invest</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Account Activation</a>
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
              <form class="m-t" role="form" method="post" action="{{URL::to('preregister/activatedownline')}}">
                @csrf
                <div class="form-group">
                  <!-- <label>User ID</label> -->
                    <input type="hidden" style="display:hidden;" name="user_id" class="form-control" value="{{Auth::user()->user_id}}" placeholder="User ID" required="">
                    <input type="hidden" style="display:hidden;" name="downline_id" class="form-control" value="{{Request::segment(3)}}" placeholder="User ID" required="">
                </div>
                  <div class="form-group">
                    <!-- <label>Password</label> -->
                      <input type="hidden" class="form-control" style="display:hidden;" value="{{Auth::user()->password}}" name="password" placeholder="" required="">
                  </div>

                  <div class="form-group">
                    <label>Amount</label>
                      <input type="number" class="form-control" min=="100" max="5000" name="amount" placeholder="Amount" required="">
                  </div>
                  <div class="form-group">
                    <label>Pay Type</label>
                    <select class="form-control" name="pay_type">
                        <option value="Rwallet+Virtual Wallet">Rwallet+Virtual Wallet</option>
                        <!-- <option value="Virtual Wallet">Virtual Wallet</option> -->
                        <option value="R Wallet">R Wallet</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Transaction Password</label>
                      <input type="password" class="form-control" name="transpassword" placeholder="" required="">
                  </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Activate</button>
              </form>
            </div>
          </div>
      </div>
    </div>
@endsection
