
@extends('mainlayout.app')

@section('title', 'Account Registration')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Activate</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Invest</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Account Registration</a>
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
                
                <div class="row">
                    <div class="col-lg-12">
                        <form class="m-t" role="form" method="post" action="{{URL::to('preregister/create')}}">
                          @csrf
                          <div class="form-group">
                              <label>Sponsor</label>
                              <input type="text" class="form-control"  name="sponsor_id"  placeholder="ID/Username" required="">
                          </div>
                          <div class="form-group">
                            <label>Position</label>
                              <select  class="form-control" name="position" >
                                  <option value="right">Right</option>
                                  <option value="left">Left</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label>Username</label>
                              <input type="text" name="username" class="form-control" placeholder="Username" required="">
                          </div>
                            <div class="form-group">
                              <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email address" required="">
                            </div>
                            <div class="form-group">
                              <label>Phone Number</label>
                                <input type="text" class="form-control" name="telephone" placeholder="Mobile / Telephone" required="">
                            </div>
                            <div class="form-group">
                              <label>Country</label>
                                <input type="text" class="form-control" name="country" placeholder="Country" required="">
                            </div>

                            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                        </form>
                </div>
            </div>
          </div>
      </div>
    </div>
@endsection
