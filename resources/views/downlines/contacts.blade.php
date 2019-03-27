
@extends('mainlayout.app')

@section('title', 'Downlines')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Contact</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Address Book </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Downlines</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
      <contact></contact>
  </div>
@endsection
