<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XINROX | PORTAL </title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png')}}"/>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

</head>
<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">PRE-REGISTRATION PORTAL</h2>
                    <p>
                        Please enter valid email for this email will be used to get your Account Credentials
                    </p>
                    @if(!empty(Session::get('message')))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @endif

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="post" action="{{URL::to('preregister/create')}}">
                              @csrf
                              <div class="form-group">
                                  <label>Sponsor</label>

                                  @if(Request::segment(2) !='')
                                        <input type="text" class="form-control" value="{{ Request::segment(2)}}" readonly name="sponsor_id" placeholder="ID/Username" required="">
                                      @else
                                          <input type="text" class="form-control"  name="sponsor_id" placeholder="ID/Username" required="">
                                  @endif
                                </div>
                              <div class="form-group">
                                <label>Position</label>
                                @if(Request::segment(3) !='')
                                <select  class="form-control" name="position" readonly>
                                    <option value="{{ Request::segment(3)}}">{{ Request::segment(3)}}</option>
                                    <option value="right">Right</option>
                                    <option value="left">Left</option>
                                </select>
                                @else
                                    <select  class="form-control" name="position">

                                        <option value="right">Right</option>
                                        <option value="left">Left</option>
                                    </select>
                                @endif

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
        <hr/>
        <div class="row">
          <div class="col-md-6">
              Xinrox
          </div>
          <div class="col-md-6 text-right">
             <small>© 2018-2019</small>
          </div>
        </div>
    </div>

</body>

</html>
