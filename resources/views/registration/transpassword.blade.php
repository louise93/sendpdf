<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XINROX | PORTAL </title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png')}}"/>
</head>
<body class="gray-bg">
    <div class="passwordBox animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">Xinrox Transaction Password Reset</h2>
                      <p class="text-danger">Fill up this form and we'll send you the instruction</p>
                    @if(!empty(Session::get('message')))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="post" action="{{URL::to('reset/transpassword')}}">
                              @csrf
                              <div class="form-group">
                                <label>User ID</label>
                                  <input type="text" name="user_id" class="form-control" placeholder="User ID" required="">
                              </div>
                                <div class="form-group">
                                  <label>Email</label>
                                    <input type="email" class="form-control"  name="email" placeholder="Email" required="">
                                </div>
                              <button type="submit" class="btn btn-primary block full-width m-b">Reset</button>
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
