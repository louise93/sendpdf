
@extends('mainlayout.app')

@section('title', 'Wallets')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Account</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Wallet</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Balances</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
          <div class="ibox ">
              <div class="ibox-title">
                  <div class="ibox-tools">
                      <a class="collapse-link">
                          <i class="fa fa-chevron-up"></i>
                      </a>
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          <i class="fa fa-wrench"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-user">
                          <li><a href="#" class="dropdown-item">Config option 1</a>
                          </li>
                          <li><a href="#" class="dropdown-item">Config option 2</a>
                          </li>
                      </ul>
                      <a class="close-link">
                          <i class="fa fa-times"></i>
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
                  <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
              <tr>
                  <th>#</th>
                  <th>Wallet Type</th>
                  <th>Available Balance</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
                        <tr class="gradeX">
                            <td align="center">1</td>
                            <td align="center">E Wallet</td>
                            <td align="right">$ {{ number_format(DB::table('final_e_wallet')->where('user_id',Auth::user()->user_id)->sum('amount'),2) }}</td>
                            <td>
                                <a href="{{URL::to('wallets/ewallet/transfer')}}" class="btn btn-sm btn-info" >Transfer</a>
                                <a href="{{URL::to('wallets/ewallet/withdraw')}}" class="btn btn-sm btn-warning" >Withdraw</a>
                                <a href="{{URL::to('wallets/history')}}" class="btn btn-sm btn-success" >History</a>
                            </td>
                      </tr>
                      <tr class="gradeX">
                          <td align="center">2</td>
                          <td align="center">R Wallet</td>
                          <td align="right">$ {{ number_format(DB::table('final_r_wallet')->where('user_id',Auth::user()->user_id)->sum('amount'),2) }}</td>
                          <td>
                                <a href="{{URL::to('wallets/rwallet')}}" class="btn btn-sm btn-info" >Transfer</a>
                                <a href="{{URL::to('wallets/history')}}" class="btn btn-sm btn-success" >History</a>
                          </td>
                    </tr>
                    <tr class="gradeX">
                        <td align="center">3</td>
                        <td align="center">Forex Wallet</td>
                        <td align="right">$ {{ number_format(DB::table('final_forex_wallet')->where('user_id',Auth::user()->user_id)->sum('amount'),2) }}</td>
                        <td>
                          <a href="{{URL::to('wallets/forexwallet')}}" class="btn btn-sm btn-info" >Transfer</a>
                          <a href="{{URL::to('wallets/history')}}" class="btn btn-sm btn-success" >History</a>
                        </td>
                  </tr>
                  <tr class="gradeX">
                      <td align="center">4</td>
                      <td align="center">Virtual Wallet</td>
                      <td align="right">$ {{ number_format(DB::table('final_apin_wallet')->where('user_id',Auth::user()->user_id)->sum('amount'),2) }}</td>
                      <td>
                        <a href="{{URL::to('wallets/virtualwallet')}}" class="btn btn-sm btn-info" >Transfer</a>
                        <a href="{{URL::to('wallets/history')}}" class="btn btn-sm btn-success" >History</a>
                      </td>
                </tr>
              </tbody>
              </table>
                  </div>
              </div>
          </div>
      </div>
      </div>
  </div>
@endsection
@section('scripts')

<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'Direct Sponsors'},
                {extend: 'pdf', title: 'Direct Sponsors'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

    });

</script>


@endsection
