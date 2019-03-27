
@extends('admin.layout.app')

@section('title', 'Admin | Users | Genealogy Tree')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Users</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Genealogy</a>
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
                <form class="m-t" role="form" method="post" action="{{URL::to('admin/members/genealogy/search')}}">
                  @csrf
                    <div class="form-group">
                      <label>User ID</label>
                        <input type="text" class="form-control" name="user_id" placeholder="User" required="">
                    </div>
                  <button type="submit" class="btn btn-primary block full-width m-b">Search</button>
                </form>

              </div>
            </div>
        </div>
      </div>
@endsection
