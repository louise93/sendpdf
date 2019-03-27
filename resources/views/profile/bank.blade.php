
@extends('mainlayout.app')

@section('title', 'Profile')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profile</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Bank</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Bank Info</a>
                        </li>

                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
    <bank></bank>
  </div>
@endsection
