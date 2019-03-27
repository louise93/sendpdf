
@extends('mainlayout.app')

@section('title', 'Profile')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profile</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="i#">KYC</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Documents</a>
                        </li>

                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        @if(!empty(Session::get('message')))
            @if(Session::get('type') =='error')
            <div class="alert alert-danger">{{Session::get('message')}}</div>
            @else
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif
        @endif
      </div>
      <div class="row animated fadeInRight">
              <div class="col-md-4">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>KYC Detail</h5>
                          <p class="text-danger">Accepted files : jpg | png </p>
                      </div>
                      <div>
                          <div class="ibox-content no-padding border-left-right">
                              <img alt="image" class="img-fluid" src="{{ asset('img/')}}/{{Auth::user()->id_no}}">
                          </div>
                          <div class="ibox-content profile-content">
                              <h4><strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong></h4>
                              <p><i class="fa fa-map-marker"></i> {{ Auth::user()->address }}</p>
                              <div class="user-button">
                                  <div class="row">
                                      <div class="col-md-12">
                                        <form action="{{URL::to('profile/kyc/uploadphoto')}}" method="POST" enctype="multipart/form-data">
                                           {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Select Photo</label>
                                                <input type="file" name="photo" class="form-control">
                                            </div>
                                          <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-camera"> </i> UPLOAD PHOTO</button>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                  </div>
              </div>
            </div>
              <div class="col-md-8">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>Uploaded Documents</h5>
                            <p class="text-danger">Accepted files : jpg | png </p>
                      </div>
                      <div class="ibox-content">
                          <div>
                              <div class="feed-activity-list">
                                  <div class="feed-element">
                                      <div class="media-body ">
                                          <div class="photos">
                                              <a target="_blank" href="{{ asset('img/')}}/{{Auth::user()->id_card}}"> <img alt="image" class="feed-photo" src="{{ asset('img/')}}/{{Auth::user()->id_card}}"></a>
                                              <a target="_blank" href="{{ asset('img/')}}/{{Auth::user()->master_account}}"> <img alt="image" class="feed-photo" src="{{ asset('img/')}}/{{Auth::user()->master_account}}"></a>
                                              </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                    <form action="{{URL::to('profile/kyc/uploadid')}}" method="POST" enctype="multipart/form-data">
                                       {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Select Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                      <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-camera"> </i> UPLOAD PHOTO</button>
                                    </form>
                                      </div>
                                  <div class="col-md-6">
                                    <form action="{{URL::to('profile/kyc/uploadaddress')}}" method="POST" enctype="multipart/form-data">
                                       {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Select Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                      <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-camera"> </i> UPLOAD PHOTO</button>
                                    </form>
                                  </div>

                              </div>

                          </div>

                      </div>
                  </div>

              </div>
          </div>
  </div>


@endsection
